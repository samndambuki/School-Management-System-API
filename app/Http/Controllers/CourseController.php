<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json(['courses', $courses], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $course = Course::create($request->all());
        return response()->json(['course' => $course], 201);
    }

    public function show($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        return response()->json(['course', $course], 200);

    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            //404 - not found
            return response()->json(['error', 'Course not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'string|required',
            'description' => 'string|required'
        ]);

        if ($validator->fails()) {
            //400 - bad requests
            return response()->json(['error' => $validator->errors()], 400);
        }

        $course->update($request->all());
        //201 - created
        return response()->json(['course', $course], 201);
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }
        $course->delete();
        //200 - OK 
        return response()->json(['message' => 'Teacher deleted successfully'], 200);
    }
}
