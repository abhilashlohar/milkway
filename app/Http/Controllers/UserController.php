<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(5);
  
        return view('users.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate(user::rules(), user::messages());

        User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
        ]);
   
        return redirect()->route('users.index')
                        ->with('success','user created successfully.');
    }

    public function show(user $user)
    {
        //
    }

    public function edit(user $user)
    {
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, user $user)
    {
        $request->validate(user::rules($user->id), user::messages());

        $update_data['name']      =  $request['name'];
        $update_data['username']  =  $request['username'];
        if ($request['password']) $update_data['password'] =  Hash::make($request['password']);

        $user->update($update_data);
  
        return redirect()->route('users.index')
                        ->with('success','user updated successfully');
    }

    public function destroy(user $user)
    {
        $user->deleted = true;
        $user->save();
  
        return redirect()->route('users.index')
                        ->with('success','user deleted successfully');
    }
}
