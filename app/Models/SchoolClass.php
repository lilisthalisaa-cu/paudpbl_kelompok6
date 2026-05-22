<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;
use App\Models\Student;

class SchoolClass extends Model
{
    protected $fillable = [
        'name',
        'level',
        'description'
    ];

    // relasi siswa
    public function students()
    {
        return $this->hasMany(Student::class, 'school_class_id');
    }

    // relasi guru
    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'school_class_id');
    }
}