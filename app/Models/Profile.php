<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [

        // PROFILE
        'title',
        'description',
        'image',

        // CONTACT
        'address',
        'email',
        'phone',

        // SCHOOL INFO
        'npsn',
        'principal',
        'established',

        // VISI MISI
        'vision',
        'mission',
    ];
}