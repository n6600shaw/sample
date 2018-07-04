<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function create(){

        return view('users.create');


    }
    public function show(User $user){

        return view('users.show',compact('user'));
    }

    public function store(Request $request){
        $this->validate($request,[
             'name'=>'required|max:50',
             'email'=>'required|unique:users|email',
             'password'=>'required|min:6',
             'password_confirmation'=>'same:password'


        ]);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]
        );
        
        session()->flash('success','Welcome!');
        return redirect()->route('users.show',[$user]);

    }
}
