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
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string'
        ]);

        //array_diff - calculates the difefrence in 2 arrays 
        //in this case the keys in request payload and keys in validated data
        //the result is an array with keys that exists in the request payload but not in validated data 
        $extraFields = array_diff(array_keys($request->all()), array_keys($validatedData));
        //this condition checks if there are any extra fields in the request payload
        //if extra fields array is not empty it means there are extra fields
        if (!empty($extraFields)) {
            // implode - used to concatenate strings in this case separated by commas
            return response()->json(['error' => 'Unrecognized Fields : ' . implode(', ', $extraFields)], 400);
        }

        //create a student
        $student = Student::create($validatedData);

        //response->json() - constructs a new json reponse
        //[] - data to be included in the json reponse
        //201 - this is the http status code created
        return response()->json(['student' => $student], 201);
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

        //validate incoming request data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string'
        ]);

        //check if validation falis
        if ($validator->fails()) {
            //if validation  fails return a JSON respionse with validation errors and 404 status code
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
