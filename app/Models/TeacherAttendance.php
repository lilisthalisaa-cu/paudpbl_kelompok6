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
        'jam_masuk',
        'jam_pulang',
        'status',
        'note',
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
