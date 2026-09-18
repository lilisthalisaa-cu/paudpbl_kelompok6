<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [

        'name',
        'username',
        'email',
        'nip',
        'npsn',
        'password',
        'role',
    ];

    protected $hidden = [

        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function teacher()
    {
        return $this->hasOne(
            Teacher::class
        );
    }

    public function students()
    {
        return $this->hasMany(
            Student::class,
            'parent_id'
        );
    }
}