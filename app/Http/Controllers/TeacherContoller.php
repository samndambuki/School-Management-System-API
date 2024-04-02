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

    public function show($id)
    {
        $teacher = Teacher::find($id);
        if (!$teacher) {
            return response()->json(['error', 'Teacher not found'], 400);
        }
        return response()->json(['teacher' => $teacher], 200);
    }

    public function update(Request $request, $id)
    {
        //find the teacher
        //if teacher with corresponding id is found, he wil be assigned to the teacher variable
        //otherwise teacher will be null 
        $teacher = Teacher::find($id);
        //we check if teacher variable is null, indicating teacher with the given id is not found
        if (!$teacher) {
            return response()->json(['error' => 'Teacher not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'qualification' => 'required|string'
        ]);

        if (validator()->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        //if the validation passses we update the teacher record with the new data from the request
        $teacher->update($request->all());

        //return a JSON response containing the updated teachers dara along with OK status code
        return response()->json(['teacher' => $teacher], 200);
    }

    //delete a teacher 
    public function destroy($id)
    {
        //find the teacher
        $teacher = Teacher::find($id);
        if (!$teacher) {
            return response()->json(['error' => 'Teacher not found'], 404);
        }
        $teacher->delete();
        return response()->json(['message' => 'Teacher deleted successfully'], 200);
    }
}
