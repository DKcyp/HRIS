<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAuth extends Authenticatable
{
    protected $connection = 'pgsql';
    protected $table = 'user_auth';
    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'nama',
        'email',
        'password',
        'role',
        'status',
        'last_login',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'last_login' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
        return '';
    }

    public function getRolePermissions()
    {
        $role = Role::where('nama', $this->role)->first();
        return $role ? $role->permissions : collect();
    }
}
