<?php

namespace App\Traits\Permissions;


use App\Models\User\Permission;
use App\Models\User\Role;

trait HasPermissionTrait
{

    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('name',$permission)->count();
    }

    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }
	
    public function hasPermissionTo($permission)
    {
			return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);	
		
    }
	
    public function hasPermissionThroughRole($permission)
    {
		foreach($this->roles as $role)
		{
			if ($role->permissions->contains('name', $permission)) {
                return true;
            }
		}
    }


}