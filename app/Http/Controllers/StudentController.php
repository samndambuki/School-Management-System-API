<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreStudentRequest;

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
        return response()->json(['students' => $students], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $student = Student::create($request->all());

        return response()->json(['student', $student], 201);
    }

    //retrive and display a single resource in this case a single student record identified by its id
    public function show($id)
    {
        //retrieve a student with a given id from the database
        $student = Student::find($id);

        //check if a student was found
        if (!$student) {
            //if a student was not found retrun a json response with an error message and a 404 status not found
            return response()->json(['error' => 'Student not found'], 404);
        }

        //if a student was found return a JSON response with the student data and a 200 status code
        return response()->json(['student' => $student], 200);
    }

    public function update(Request $request, $id)
    {
        //retrieve a student with a given id from the database
        $student = Student::find($id);

        //check if student was found
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        //update the student record with the new data
        $student->update($request->all());

        //return a JSON response with the updated student data and a 200 status code
        return response()->json(['student' => $student], 200);
    }

    public function destroy($id)
    {
        //retrieve the student with a given id from the database
        $student = Student::find($id);
        //check if student was found
        if (!$student) {
            return response()->json(['Error' => 'Student not found '], 404);
        }

        //delete student record from the database
        $student->delete();

        //return a json response
        return response()->json(['message' => 'Student deleted successfuly'], 200);
    }
}
