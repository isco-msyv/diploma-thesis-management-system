<?php

namespace App\Http\Middleware;

use App\Helpers\UserType;
use Closure;
use Illuminate\Http\Request;

class CheckUserTypeAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->type !== UserType::ADMIN) {
            return redirect()->route('profile.edit');
        }

        return $next($request);
    }
}
