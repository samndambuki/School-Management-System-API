<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();
        return response()->json(['attendances' => $attendances], 200);
    }

    public function show($id)
    {
        $attendance = Attendance::find($id);
        return response()->json(['attendance', $attendance], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'enrollment_id' => 'required|exists:enrollments,id',
            'date' => 'required|Date',
            'status' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $attendance = Attendance::create($request->all());
        return response()->json(['attendance' => $attendance], 200);
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json(['error' => 'Attendance not found']);
        }

        $validator = Validator::make($request->all(), [
            'enrollment_id' => 'required|exists:enrollments,id',
            'date' => 'required|date',
            'status' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $attendance->update($request->all());
    }

    public function destroy($id)
    {
        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response()->json(['error' => 'Attendance not found'], 404);
        }
        $attendance->delete();
        return response()->json(['message' => 'Attendance deleted successfully'], 200);
    }
}
