<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherContoller extends Controller
{
    //fetches all teachers
    public function index()
    {
        $teachers = Teacher::all();
        //200 indicates a successful response, OK status
        return response()->json(['teachers' => $teachers], 200);
    }

    //creates a new teacher 
    public function store(Request $request)
    {
        //we validate request data against a set of rules defined in the array
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'qualification' => 'required|string'
        ]);

        //if the validation fails 
        if ($validator->fails()) {
            //400 bad request
            return response()->json(['error' => $validator->errors()], 400);
        }

        //inserts a new row in the teachers table with the provided data
        //we pass the validated data from the request
        $teacher = Teacher::create($request->all());
        //status code 201 - created
        return response()->json(['teacher' => $teacher], 201);
    }
}
