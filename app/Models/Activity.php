<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [

        'teacher_id',

        'school_class_id',

        'date',

        'theme',

        'activity_1',

        'activity_2',

        'activity_3',

        'notes',

    ];

    protected $casts = [

        'date' => 'date',

    ];

    // relasi ke guru
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // relasi ke kelas
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    // relasi ke detail kegiatan siswa
    public function activityStudents()
    {
        return $this->hasMany(ActivityStudent::class);
    }
}