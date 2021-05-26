<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckStudentHasProjectOrProjectRequest
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
        if (auth()->user()->studentProject === null && auth()->user()->studentProjectRequest === null) {
            return redirect()->route('student.topics.index');
        }

        return $next($request);
    }
}
