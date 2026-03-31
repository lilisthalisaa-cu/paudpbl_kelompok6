<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Class as SchoolClass;

class Teacher extends Model
{
    protected $fillable = ['user_id', 'class_id'];

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi ke schoolclass 
    public function class()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function attendances()
    {
        return $this->hasMany(TeacherAttendance::class);
    }
}