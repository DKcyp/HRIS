<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'roles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
    }

    public function userAuths()
    {
        return $this->hasMany(UserAuth::class, 'role', 'nama');
    }
}
