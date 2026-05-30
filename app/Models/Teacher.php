<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'school_class_id',
        'phone',
        'address',
        'nip'
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    public function schoolClass()
    {
        return $this->belongsTo(
            SchoolClass::class,
            'school_class_id'
        );
    }

    public function attendances()
    {
        return $this->hasMany(
            TeacherAttendance::class
        );
    }
}