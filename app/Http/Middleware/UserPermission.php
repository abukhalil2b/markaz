<?php

namespace App\Http\Middleware;

use Closure;

class UserPermission {

	public function handle($request, Closure $next, $permission) {

		$user = $request->user();

		$userHasPermission = $user->permissions()->where('slug', $permission)->count();

		$userRolesHasPermission = $user->roles()->whereHas('permissions', function ($query) use ($permission) {
			$query->where('permissions.slug', $permission);
		})->count();

		if ($userHasPermission || $userRolesHasPermission || $user->id === 1) {
			return $next($request);
		}
		return response("<center><h1>لاتملك الصلاحيات الكافية</h1></center>", 401);
	}
}
