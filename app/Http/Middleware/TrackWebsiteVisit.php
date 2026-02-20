<?php

namespace App\Http\Middleware;

use App\Models\WebsiteVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackWebsiteVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldTrack($request, $response)) {
            WebsiteVisit::create([
                'session_id' => $request->session()->getId(),
                'ip_address' => $request->ip(),
                'path' => '/' . ltrim($request->path(), '/'),
                'referrer' => $request->headers->get('referer'),
                'month_key' => now()->format('Y-m'),
                'day' => now()->toDateString(),
                'visited_at' => now(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return $response;
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        if (!$request->isMethod('GET')) {
            return false;
        }

        if ($response->getStatusCode() >= 400) {
            return false;
        }

        if ($request->expectsJson() || $request->ajax()) {
            return false;
        }

        if ($request->is('admin') || $request->is('admin/*') || $request->is('api/*')) {
            return false;
        }

        if ($request->is('livewire/*')) {
            return false;
        }

        return true;
    }
}
