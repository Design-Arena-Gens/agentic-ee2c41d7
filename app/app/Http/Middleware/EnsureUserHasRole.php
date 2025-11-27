<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(403);
        }

        $normalizedRoles = collect($roles)
            ->map(fn (string $role) => strtoupper($role))
            ->filter()
            ->map(function (string $role) {
                return UserRole::tryFrom($role)?->value ?? $role;
            })
            ->values()
            ->all();

        if (empty($normalizedRoles)) {
            $normalizedRoles = [
                UserRole::SUPER_ADMIN->value,
                UserRole::ADMIN->value,
            ];
        }

        if (! $user->hasRole($normalizedRoles)) {
            abort(403);
        }

        return $next($request);
    }
}
