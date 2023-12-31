<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $student = Student::all();
        return view('index', compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $storeData = $request->validate([
        'name' => ['required','max:255',Rule::unique('students','name')],
        'email' => ['required','max:255',Rule::unique('students', 'email')],
        'phone' => ['required','numeric',Rule::unique('students', 'phone')],
        'password' => 'required','max:255'
    ]);



    $student = Student::create($storeData);

    return redirect('/students')->with('completed', 'Student has been saved!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $student = Student::findOrfail($id);
        return view('edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $updateData = $request->validate([
            'name' => 'required|max:255',
            'email'=> 'required|max:255',
            'phone'=> 'required|numeric',
            'password'=> 'required|max:255',
        ]);
        Student::whereId($id)->update($updateData);
        return redirect('/students')->with('completed', 'Student has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect('/students')->with('completed', 'Student has been deleted');
    }
}
