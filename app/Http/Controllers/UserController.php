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

        $validatedData = $request->validate([
            'name' => 'bail|required|max:255',
            'email' => 'bail|required|max:255|email:filter',
            'password' => 'bail|required|max:24|confirmed',
            'password_confirmation' => 'bail|required|max:24'
        ]);

        $inputName = $request->input('name');
        $inputEmail= $request->input('email');
        $inputPassword= $request->input('password');
        $confirmPassword= $request->input('password_confirmation');

      return response()->json($inputName." ".$inputEmail." ".$inputPassword." ".$confirmPassword, 200);
    }


}
