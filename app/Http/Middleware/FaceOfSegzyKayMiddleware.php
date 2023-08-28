<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Settings;
use App\Models\User;

class FaceOfSegzyKayMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $fosks = Settings::first();

        $contentants = User::participants();

        if($fosks != null) {
            if($fosks->number_of_contestant == $contentants->count()) {
                return response()->view('error.full');
            }
        } else {
            return response()->view('error.notyetlaunched');
        }

        return $next($request);
    }
}
