<?php

namespace App\Http\Controllers;

use App\Models\School_Class;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolClassController extends Controller
{
    public function index()
    {
        $classes = School_Class::all();
        return response()->json(['classes' => $classes], 200);
    }

    public function show($id)
    {
        $class = School_Class::find($id);
        if (!$class) {
            return response()->json(['error' => 'class not found'], 404);
        }
        return response()->json(['class' => $class], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string'
        ]);


        if ($validator->fails()) {
            return response()->json(['error', $validator->errors()], 400);
        }

        $class = School_Class::create($request->all());
        return response()->json(['class' => $class], 201);
    }

    public function update(Request $request, $id)
    {
        $class = School_Class::find($id);

        if (!$class) {
            return response()->json(['error' => 'Class not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $class->update($request->all());

        return response()->json(['class', $class], 200);
    }

    public function destroy($id)
    {
        $class = School_Class::find($id);
        if (!$class) {
            return response()->json(['error' => 'Class not found'], 404);
        }
        $class->delete();
        return response()->json(['message' => 'Teacher deleted successfully'], 200);
    }
}
