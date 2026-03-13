<?php

namespace App\Http\Middleware;

use App\Models\MaintenanceRoute;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        // Admin users bypass maintenance mode
        if (auth()->check()) {
            return $next($request);
        }

        $routeName = $request->route()?->getName();

        if ($routeName) {
            // Check global maintenance (route_name = '*')
            $global = MaintenanceRoute::where('route_name', '*')->where('is_active', true)->first();
            if ($global) {
                return response()->view('maintenance', [
                    'message' => $global->message ?: 'We are currently performing scheduled maintenance. Please check back soon.',
                    'routeName' => $routeName,
                ], 503);
            }

            // Check per-route maintenance
            $route = MaintenanceRoute::where('route_name', $routeName)->where('is_active', true)->first();
            if ($route) {
                return response()->view('maintenance', [
                    'message' => $route->message ?: 'This page is currently under maintenance. Please check back soon.',
                    'routeName' => $routeName,
                ], 503);
            }
        }

        return $next($request);
    }
}
