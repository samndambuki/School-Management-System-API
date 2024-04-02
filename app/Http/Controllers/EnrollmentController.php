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
            ''
        ]);
    }
}
