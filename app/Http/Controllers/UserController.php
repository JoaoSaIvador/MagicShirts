<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        //if(!logged)
        return view('user.Login')->withPageTitle('Entrar');
    }

    public function registerPage()
    {
       echo(csrf_token());
        return view('user.Register')->withPageTitle('Registar');
    }

    public function register(Request $request)
    {
        
      $inputName = $request->input('name');
      $inputEmail= $request->input('email');
      $inputPassword= $request->input('password');
      $confirmPassword= $request->input('confirmPassword');

      return response()->json($inputName." ".$inputEmail." ".$inputPassword." ".$confirmPassword, 200);
    }


}
