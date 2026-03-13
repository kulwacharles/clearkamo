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
        // NOTE: No auth bypass here — even logged-in admin users see the maintenance
        // page on the frontend. Admins can still access /admin/* routes because
        // those routes are in a separate middleware group (not covered by this middleware).

        $routeName = $request->route()?->getName();

        try {
            // Check global maintenance (route_name = '*') — activated by "Enable All"
            $global = MaintenanceRoute::where('route_name', '*')->where('is_active', true)->first();
            if ($global) {
                return response()->view('maintenance', [
                    'message' => $global->message ?: 'We are currently performing scheduled maintenance. Please check back soon.',
                    'routeName' => $routeName,
                ], 503);
            }

            // Check per-route maintenance (granular per-page control)
            if ($routeName) {
                $route = MaintenanceRoute::where('route_name', $routeName)->where('is_active', true)->first();
                if ($route) {
                    return response()->view('maintenance', [
                        'message' => $route->message ?: 'This page is currently under maintenance. Please check back soon.',
                        'routeName' => $routeName,
                    ], 503);
                }
            }
        } catch (\Exception $e) {
            // If the maintenance_routes table does not exist yet, log and allow
            // the request through so the rest of the site stays up.
            logger()->error('CheckMaintenanceMode: failed to query maintenance_routes — ' . $e->getMessage());
        }

        return $next($request);
    }
}
