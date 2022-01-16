<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
      return view('login.index', [
        'title' => 'Login',
        'active' =>'login',

      ]);
    }

    public function authenticate(Request $request){
      
      // untuk validasi form 
      $credentials = $request->validate([
        'email' => 'bail|required|email',
        'password' => 'required'
      ]);

      // method attempt akan melakukan otentikasi.
      // jika berhasil akan return true, jika salah akan return false
      if(Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
      }

      return back()->with('failure', 'Login was Failed!');

    }

    public function logout(Request $request){
      Auth::logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect('/dashboard');
    }
}
