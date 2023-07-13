<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlyAdmin
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
        // Disini memberi tahu bahwa apa yang harus dilakukan jika yang login bukan admin!!
        if(Auth::user()->role_id != 1) {
            return redirect('alatbarangs');
        }

        // Apa yang middleware lakukan ketika yang login adalah admin?
        return $next($request);
    }
}
