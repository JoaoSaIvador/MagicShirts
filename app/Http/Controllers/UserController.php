<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return view('user.Login')->withPageTitle('Entrar');
    }

    public function registerPage()
    {
        return view('user.Register')->withPageTitle('Registar');
    }

    public function Register()
    {
      
    }


}
