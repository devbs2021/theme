<?php

namespace DevbShrestha\Theme\Middleware;

use Closure;
use Illuminate\Http\Request;
use Theme;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $moduleName)
    {
        if (!Theme::checkModuleStatus($moduleName)) {
            abort(404);
        }
        return $next($request);
    }
}
