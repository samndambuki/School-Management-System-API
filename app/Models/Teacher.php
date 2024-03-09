<?php

//declares that the Teacher class is within the App\Models namespace
namespace App\Models;

//this line imports Model Illuminate\Database\Eloquent namespace.
//Laravel's Eloquent ORM is used to interact with databases
//Model provides a set of features to work with databse records
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;


//Teacher class inherits functionalities provided by the Model class
//allowing it to interact with the database using eloquent
class Teacher extends Model
{
    //$fillable - [ ] - this is an array that specifies which attributes of the Teacher model can be mass assigned
    //mass assignment - a way of setting multiple attributes of a Model at once
    //these are attributes that can be set when creating or updating a Teacher record
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'address',
        'phone_number',
        'qualification'
    ];

    //relationship definition
    public function courses()
    {
        //define a many to many relationship between a Teacher and a Course
        //'course_teacher' is a pivot table used to store relationships between records
        return $this->belongsToMany(Course::class, 'course_teacher');
    }
}
