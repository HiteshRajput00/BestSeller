<?php

namespace App\Http\Middleware;

use Closure;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Is_approved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
           if((Auth::user()->is_disapproved === false && Auth::user()->is_approved === false)||(  Auth::user()->is_disapproved === true )){
                Alert::warning('Not Approved', 'You are not approved. Contact admin for approval.')->persistent(true, true);
                return redirect()->back();
            }else{
                return $next($request);
            }
       
    }
}

