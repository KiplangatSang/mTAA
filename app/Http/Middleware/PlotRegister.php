<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlotRegister
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
        if (Auth::user()) {
            $user = User::where('id', auth()->id())
                ->first();
            if ($user->landlord()->first()->has('plotlocations')) {
                return $next($request);
            }
        }
        return redirect(route(route('landlord.plotlocation.create')))->with('error', 'You have not registered any plot');
    }
}
