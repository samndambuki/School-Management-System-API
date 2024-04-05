<?php

namespace App\Models;

use App\Models\Grade;
use App\Traits\Uuids;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\School_Class;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory, Uuids;
    //mass assignment - determines which attributes of a model can be set at once
    //these are attributes that can be set when creating or updating a record at once
    protected $fillable = [
        'student_id',
        'class_id'
    ];

    //relationship definitions
    public function student()
    {
        //many to one 
        //belongsTo method is provided by eloquent
        return $this->belongsTo(Student::class);
    }

    public function school_class()
    {
        //many to one relationship
        return $this->belongsTo(School_Class::class);
    }

    public function grade()
    {
        //one to one relationship
        return $this->hasOne(Grade::class);
    }

    public function attendances()
    {
        //one to many relationship
        return $this->hasMany(Attendance::class);
    }
}
