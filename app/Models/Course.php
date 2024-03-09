<?php

//namespace declaration - decares that the Course class is within the App\Models namespace;
namespace App\Models;

//Model class provides a set of methods and features for interacting with databse records
use Illuminate\Database\Eloquent\Model;
use App\Models\Enrollment;

use App\Models\Teacher;


//this means the Course class inherits all functionalities provided by Model class
class Course extends Model
{
    //mass assignment is a way to quickly set multiple attributes of a model at once
    //these are attributes that can be set when creating or updating a Course record
    protected $fillable = [
        'title',
        'description'
    ];

    //relationship definiton
    //many to many relationship definition
    public function teachers()
    {
        //defines a many to many relationship between course model and teacher model 
        //belongsToMany - is a method provided by eloquent
        //course_teacher specifies the pivot table name
        //pivot table is used to store relationships between records
        return $this->belongsToMany(Teacher::class, 'course_teacher');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

}

