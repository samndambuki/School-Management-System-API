<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::all();
        return response()->json(['enrollments' => $enrollments], 200);
    }

    public function show($id)
    {
        $enrollment = Enrollment::find($id);
        if (!$enrollment) {
            return response()->json(['error' => 'Enrollment not found'], 404);
        }
        return response()->json(['enrollment' => $enrollment], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error', $validator->errors()], 400);
        }

        $enrollment = Enrollment::create($request->all());
        return response()->json(['enrollment' => $enrollment], 201);
    }

    public function update(Request $request, $id)
    {

        $enrollment = Enrollment::find($id);

        if (!$enrollment) {
            return response()->json(['error', 'Enrollemnt not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error', $validator->errors()], 400);
        }

        $enrollment->update($request->all());

        return response()->json(['enrollemnt', $enrollment], 200);

    }

    public function destroy($id)
    {
        $enrollment = Enrollment::find($id);
        if (!$enrollment) {
            return response()->json(['error', 'Enrollment not found'], 404);
        }
        $enrollment->delete();
        return response()->json(['message' => 'Enrollment deleted successfully'], 200);
    }
}
