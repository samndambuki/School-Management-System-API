<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    //this method is responsible or fetching a list of students and returning them 
    //as a json reponse
    public function index()
    {
        //we query the Student model to retrieve all records from the databse
        //here we use all() method to fetch all rows from the student table
        $students = Student::all();
        //we return a json reponse containing a list of students
        //200 indicates a successful status code
        return response()->json(['students', $students], 200);
    }

    //create a new sttudent record
    public function store(Request $request)
    {

        //create a validator instance using Laravel's Validator facade 
        //define validation rules for incoming request data
        //create a new validator instance using Validator::make

        //$request->all() - retrieve al input data from incoming request
        $validator = Validator::make(
            $request->all(),
            //associative array with keys and values 
            [
                //Validation rules
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'date_of_birth' => 'required|date',
                'gender' => 'required|string',
                'address' => 'required|string',
                'phone_number' => 'required|string'
            ]
        );

        //Validation failure check
        //400 - bad request
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        //create a student
        $student = Student::create($request->all());

        //response->json() - constructs a new json reponse
        //[] - data to be included in the json reponse
        //201 - this is the http status code created
        return response()->json(['student' => $student], 201);
    }


}
