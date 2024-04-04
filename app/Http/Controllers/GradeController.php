<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        return response()->json(['grades' => $grades], 200);
    }

    public function show($id)
    {
        $grade = Grade::find($id);
        if (!$grade) {
            return response()->json(['error' => 'Grade not found'], 404);
        }
        return response()->json(['grade' => $grade], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'enrollment_id' => 'required|exists:enrollemnts,id',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
            'marks' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['error', $validator->errors()], 400);
        }

        $grade = Grade::create($request->all());
        return response()->json(['grade', $grade], 201);
    }

    public function update(Request $request, $id)
    {
        $grade = Grade::find($id);
        if (!$grade) {
            return response()->json(['error' => 'Grade not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'enrollment_id' => 'rquired|exists:enrollments,id',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
            'marks' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $grade->update($request->all());
        return response()->json(['grade' => $grade], 200);
    }

    public function destroy($id)
    {
        $grade = Grade::find($id);
        if (!$grade) {
            return response()->json(['error' => 'Grade not found'], 404);
        }
        $grade->delete();
        return response()->json(['message' => 'Grade Deleted successfully'], 200);
    }
}
