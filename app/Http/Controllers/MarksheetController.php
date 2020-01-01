<?php

namespace App\Http\Controllers;

use App\Marksheet;
use App\Semester;
use App\Year;
use Illuminate\Http\Request;
use File;

class MarksheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $student_id = $request->student_id;
        $semesters = Semester::all();
        $years = Year::all();
        return view('marksheets.create',compact('semesters','years','student_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Marksheet::rules(), Marksheet::messages());
        $fileName = time().'.'.$request->marksheet_file->extension();  
        $request->marksheet_file->move(public_path('uploads'), $fileName);
        $request->request->add(['marksheet_src' => $fileName]);

        Marksheet::create($request->all());
   
        return redirect()->route('students.show',$request->student_id)
            ->with('success','You have successfully upload marksheet.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marksheet  $marksheet
     * @return \Illuminate\Http\Response
     */
    public function show(Marksheet $marksheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marksheet  $marksheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Marksheet $marksheet)
    {
        $semesters = Semester::all();
        $years = Year::all();
        return view('marksheets.edit',compact('marksheet','semesters','years'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marksheet  $marksheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marksheet $marksheet)
    {
        $request->validate(Marksheet::rules(), Marksheet::messages());
        $destinationPath = public_path('uploads');
        
        File::delete($destinationPath.'/'.$marksheet->marksheet_src);  /// Unlink File

        $fileName = time().'.'.$request->marksheet_file->extension();  
        $request->marksheet_file->move(public_path('uploads'), $fileName);
        $request->request->add(['marksheet_src' => $fileName]);
        $request->request->add(['student_id' => $marksheet->student_id]);

        Marksheet::create($request->all());
   
        return redirect()->route('students.show',$request->student_id)
            ->with('success','You have successfully upload marksheet.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marksheet  $marksheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marksheet $marksheet)
    {
        //
    }
}
