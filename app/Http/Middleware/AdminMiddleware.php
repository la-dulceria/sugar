<?php

namespace App\Http\Middleware;

use Closure;
use Domain\Entities\User;
use Domain\Enums\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();

        if (
            !$user ||
            $user->role !== UserRoles::ADMIN
        ) {
            abort(404);
        }

        return $next($request);
    }
}
