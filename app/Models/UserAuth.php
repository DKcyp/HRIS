<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAuth extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'global.user_auth';
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
}
