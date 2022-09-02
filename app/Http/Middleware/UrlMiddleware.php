<?php

namespace App\Http\Middleware;

use App\Models\Url;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class UrlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $short_url = ($request->route())->parameter('short');
        $url = Url::where('short', $short_url)->first();

        // Case of short url doesn't exist
        if (!$url) {
            abort(404);
        }

        // Case when expired
        if (!$url->expired_at->isFuture()) {
            return abort(404);
        }

        // The case when the click limit is exceeded
        if ($url->limit > 0 && $url->limit === $url->clicks) {
            return abort(404);
        }

        $response = $next($request);

        $response->header("Expires", Carbon::now()->subDay()->format("D, d M Y H:i:s") . " GMT");
        $response->header("Last-Modified", gmdate("D, d M Y H:i:s") . " GMT");
        $response->header("Cache-Control", "no-store, no-cache, must-revalidate, max-age=0");
        $response->header("Cache-Control", "post-check=0, pre-check=0", false);
        $response->header("Pragma", "no-cache");
        $response->header("Connection", "close");

        return $response;
    }
}
