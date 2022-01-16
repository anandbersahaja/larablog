<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeRegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function create(){
      return view('register.index', [
        'title' => 'Register',
        'active' =>'register',

      ]);
    }

    //  Melakukan Validasi
    public function store(storeRegisterRequest $request){

      $validated = $request->validated();

      $validated['password'] = Hash::make($validated['password']);

      User::create($validated);

      return redirect('login')->with('success', 'Registration Successfull! Please Login');

    }
    
    // CARA LAIN UNTUK VALIDASI
    // public function store(Request $request){

    //   // return $request->all();
      
    //   $validatedData = $request->validate([
    //     'name' => 'bail|required|min:8|max:255',
    //     'username' => 'bail|required|unique:users|min:5|max:15',
    //     'email' => ['bail', 'required', 'email:dns', 'unique:users'],
    //     'password' => ['required', 'min:5', 'max:255']
    //   ]);

    //   $validatedData['password'] = bcrypt($validatedData['password']);

    //   User::create($validatedData);

    //   // cara 1 untuk return message 
    //   // $request->session()->flash('success', 'Registration Successfull! Please Login');
      
    //   return redirect('login')->with('success', 'Registration Successfull! Please Login');

    // }

}
