<?php

namespace App\Http\Controllers;

use App\Stream;
use App\Course;
use Illuminate\Http\Request;
//use Illuminate\Database\Eloquent\Model\Course;
class StreamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $streams = Stream::with('course')->paginate(5);
        return view('streams.index',compact('streams'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        return view('streams.create',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Stream::rules(), Stream::messages());

        Stream::create($request->all());
   
        return redirect()->route('streams.index')
                        ->with('success','Stream created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function show(Stream $stream)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function edit(Stream $stream)
    {
        $courses = Course::all();
        return view('streams.edit',compact('stream','courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stream $stream)
    {
        $request->validate(Stream::rules($stream->id), Stream::messages());
  
        $stream->update($request->all());
  
        return redirect()->route('streams.index')
                        ->with('success','Stream updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stream $stream)
    {
        $stream->deleted = true;
        $stream->save();
  
        return redirect()->route('streams.index')
                        ->with('success','Stream deleted successfully');
    }

     /**
     * Provides a select box's options 
     *
     * @param  \App\Stream  $stream
     * @return \Illuminate\Http\Response
     */ 
    public function list(Request $request)
    {
        $streams = Stream::latest()->where('course_id', $request->course_id)->get();
        return view('streams.list', compact('streams'));
    }
}
