<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyChecklist extends Model
{
    use HasFactory;

    protected $table = 'daily_checklists';

    protected $fillable = [

        'teacher_id',

        'student_id',

        'school_class_id',

        'date',

        'theme',

        'context',

        'observation',

        'status',

        'note',

    ];

    protected $casts = [

        'date' => 'date',

    ];

    // Relasi ke guru
    public function teacher()
    {
        return $this->belongsTo(
            Teacher::class
        );
    }

    // Relasi ke siswa
    public function student()
    {
        return $this->belongsTo(
            Student::class
        );
    }

    // Relasi ke kelas
    public function schoolClass()
    {
        return $this->belongsTo(
            SchoolClass::class
        );
    }
}