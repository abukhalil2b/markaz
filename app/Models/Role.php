<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
	public $timestamps = false;

	public function permissions() {
		return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
	}

	public function users() {
		return $this->belongsToMany(User::class, 'user_has_roles', 'role_id', 'user_id');
	}

	public function canPermission($slug) {
		return (bool) $this->permissions()->where('slug', $slug)->count();
	}
}
