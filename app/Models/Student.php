<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SchoolClass;

class Student extends Model
{
    protected $fillable = [
        'nisn',
        'name',
        'gender',
        'address',
        'parent_name',
        'parent_phone',
        'school_class_id', 
        'is_active',
        'parent_id'
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }

    public function payments()
    {
        return $this->hasMany(\App\Models\Payment::class);
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\ParentAccount::class, 'parent_id');
    }
}