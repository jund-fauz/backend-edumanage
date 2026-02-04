<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classroom_id = $request->query('classroom_id');

        if (empty($classroom_id)) {
            $students = Student::all()->groupBy('classroom_id');
        } else {
            $students = Student::all()->where('classroom_id', $classroom_id)->values()->toArray();
        }

        return response()->json(['message' => 'Data fetched successfully', 'data' => $students]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3',
            'address' => 'required|string|min:5',
            'birthday' => 'required|date',
            'classroom_id' => 'required|integer',
        ]);

        try {
            $student = Student::create($data);

            return response()->json(['message' => 'Data created successfully', 'data' => $student], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => 'string|min:3',
            'address' => 'string|min:5',
            'birthday' => 'date',
            'classroom_id' => 'integer',
        ]);

        try {
            $student->update($data);

            return response()->json(['message' => 'Data updated successfully', 'data' => $student]);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            $student->delete();

            return response()->json(['message' => 'Data deleted successfully']);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
