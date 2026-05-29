<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityStudent extends Model
{
    use HasFactory;

    protected $table = 'activity_students';

    protected $fillable = [

        'activity_id',
        'student_id',

        'desc_1',
        'desc_2',
        'desc_3',

        'photo',

    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}