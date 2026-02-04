<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Exception;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $relation = $request->query('relation');

        $classrooms = [];

        if (empty($relation)) {
            $classrooms = Classroom::with('teachers')->with('students')->get();
        } else if ($relation == 'teacher') {
            $classrooms = Classroom::with('teachers')->get();
        } else if ($relation == 'student') {
            $classrooms = Classroom::with('students')->get();
        } else if ($relation == 'none') {
            $classrooms = Classroom::all();
        }

        return response()->json(['message' => 'Data fetched successfully', 'data' => $classrooms]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3',
        ]);

        try {
            $classroom = Classroom::create($data);

            return response()->json(['message' => 'Data created successfully', 'data' => $classroom], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $data = $request->validate([
            'name' => 'string|min:3',
        ]);

        try {
            $classroom->update($data);

            return response()->json(['message' => 'Data updated successfully', 'data' => $classroom]);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        try {
            $classroom->delete();

            return response()->json(['message' => 'Data deleted successfully']);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
