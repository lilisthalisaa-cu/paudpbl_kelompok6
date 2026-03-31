<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;

class SchoolClass extends Model
{
    protected $fillable = ['name', 'level', 'description'];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'class_id');
    }
}