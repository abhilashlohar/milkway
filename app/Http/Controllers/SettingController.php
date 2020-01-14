<?php

namespace App\Http\Controllers;
use App\Setting;
use Illuminate\Http\Request;
use DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $setting = Setting::all()->first();
       return view('settings.index',compact('setting'));
    }

    
    public function store(Request $request)
    {   
        if($request->id=='')
        {  
            $request->validate(Setting::rules(), Setting::messages());
            
            Setting::create($request->all());
        }
        else{  
            $request->validate(Setting::rules($request->id), Setting::messages());
            $setting = Setting::where('id', $request->id)
                               ->first(); 
            $setting->update($request->all());
        }
        return redirect()->route('settings.index')
                        ->with('success','Setting added successfully.');
    }

}
