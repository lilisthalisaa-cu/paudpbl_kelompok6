<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [

        'title',
        'description',
        'image',

        'npsn',
        'address',
        'email',
        'phone',
        'principal',
        'established',

        'vision',
        'mission',
    ];
}