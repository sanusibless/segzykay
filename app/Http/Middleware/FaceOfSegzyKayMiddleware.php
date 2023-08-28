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

        $contents = User::participants();
        if($fosks->number_of_contestant == )
        return $next($request);
    }
}
