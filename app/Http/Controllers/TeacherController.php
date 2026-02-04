<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classroom_id = $request->query('classroom_id');

        if (empty($classroom_id)) {
            $teachers = Teacher::all()->groupBy('classroom_id');
        } else {
            $teachers = Teacher::all()->where('classroom_id', $classroom_id)->values()->toArray();
        }

        return response()->json(['message' => 'Data fetched successfully', 'data' => $teachers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3',
            'lessons' => 'array',
            'classroom_id' => 'required|integer',
        ]);

        try {
            $teacher = Teacher::create($data);

            return response()->json(['message' => 'Data created successfully', 'data' => $teacher], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'name' => 'string|min:3',
            'lessons' => 'array',
            'classroom_id' => 'integer',
        ]);

        try {
            $teacher->update($data);

            return response()->json(['message' => 'Data updated successfully', 'data' => $teacher]);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        try {
            $teacher->delete();

            return response()->json(['message' => 'Data deleted successfully']);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
