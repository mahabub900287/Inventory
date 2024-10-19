<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->type == User::USER_TYPE_ADMIN) {
                return $next($request);
            } else {
                $notify[] = ['error', 'Your account is not a admin account'];
                return redirect()->route('front.home')->withNotify($notify);
            }
        }

        return redirect()->back();
    }
}
