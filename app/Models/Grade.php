<?php

//namespace declaration
namespace App\Models;

//import Model class from illuminate\Database\Eloquent namespace
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;

use App\Models\Course;

use App\Models\Enrollment;


//Grade class inherits all functionalities provided by Model allowing it interact with the database using eloquent
class Grade extends Model
{
    //$fillable - property that specifies which attributes can be mass assigned
    //mass-assignment - setting multiple attributes of a model at once
    protected $fillable = [
        'enrollment_id',
        'course_id',
        'teacher_id',
        'marks'
    ];

    //relatoionship definitions - allows easy retrieval of data
    public function enrollment()
    {
        //many to one relationship
        return $this->belongsTo(Enrollment::class);
    }

    public function course()
    {
        //many to one relationship
        //belongsTo method is provided b eloquent
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

}
