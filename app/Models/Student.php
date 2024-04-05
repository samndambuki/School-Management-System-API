<?php


//student class is within the App\Models namespace
//namespace is used to organize classes to avoid naming conflicts
namespace App\Models;


//laravel's Object Relation Mapping is used to interact with databses
//Model class provides a set of methods and features to interact with database records
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Enrollment;


//Student class inherits all functionalities provided by model class
//allowing it to interact with the database using eloquent
class Student extends Model
{
    use HasFactory, Uuids;
    //$fillable is an array that specifies which attributes of the Student model can be mass assigned 
    //these are the attributes that can be set when creating or updating a student
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'address',
        'phone_number'
    ];

    //defines a one to many relationship between Student model and Enrollment model
    //states that a student can have many enrollments
    //done using hasMany() method provided by eloquent
    public function enrollments()
    {
        //one-to-many relationship
        //Enrollment::class - specifies the model in this case
        return $this->hasMany((Enrollment::class));
    }
}
