<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SchoolClass;


class Teacher extends Model
{
    
    protected $fillable = [
        'user_id', 
        'school_class_id'
    ];

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi ke schoolclass 
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }

    // public function attendances()
    // {
    //     return $this->hasMany(TeacherAttendance::class);
    // }
}