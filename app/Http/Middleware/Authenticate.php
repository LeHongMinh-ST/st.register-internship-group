<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        //Teacher
        if ($request->is('teacher/*')) {
            return route('teacher.teacher-login');
        }

        //User
        return $request->expectsJson() ? null : route('login');
        
    }
}
