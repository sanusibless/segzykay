<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
<<<<<<< HEAD
use App\Models\Settings;
use App\Models\User;
=======
>>>>>>> 0bf83c7677d88573de4262a30274430f09f1e68a

class FaceOfSegzyKayMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
<<<<<<< HEAD
        $fosks = Settings::first();

        $contents = User::participants();
        if($fosks->number_of_contestant == )
=======
>>>>>>> 0bf83c7677d88573de4262a30274430f09f1e68a
        return $next($request);
    }
}
