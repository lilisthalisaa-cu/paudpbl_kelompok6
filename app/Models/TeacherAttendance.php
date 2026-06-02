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
        'surat',
        'check_in',
        'check_out',
    ];

    protected $casts = [
        'date' => 'date',
        'check_in' => 'string',
        'check_out' => 'string',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
