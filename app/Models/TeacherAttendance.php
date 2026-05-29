<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'date',
        'status',
        'note',
        'jam_masuk',
        'jam_pulang',
        'surat',
    ];

    protected $casts = [
        'date' => 'date',
        'jam_masuk' => 'string',
        'jam_pulang' => 'string',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}