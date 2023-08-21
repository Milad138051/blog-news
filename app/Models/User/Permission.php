<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Role;
use App\Models\User;


class Permission extends Model
{
    use HasFactory;
	protected $fillable = ['name', 'description'];

	
	public function roles()
	{
		return $this->belongsToMany(Role::class);
	}	
	
	public function users()
	{
		return $this->belongsToMany(User::class);
	}
	

}
