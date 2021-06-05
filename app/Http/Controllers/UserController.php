<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Models\Users;

class UserController extends Controller
{

    public function index()
    {
        //if(!logged)
        return view('user.Login')->withPageTitle('Entrar');
    }

    public function indexUsers(Request $request)
    {
        $listaUsers = User::select('id', 'name', 'created_at', 'tipo', 'bloqueado')->paginate(20);

        //dd($listaUsers);

        return view('admin.UserManagement')
            ->withPageTitle('Users')
            ->withUsers($listaUsers);
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
            'password' => 'bail|required|max:24||min:8confirmed',
            'password_confirmation' => 'bail|required|max:24|min:8'
        ],
        [ // Custom Messages
            'name.required' => 'É obrigatório introduzir o nome',
            'email.required' => 'É obrigatório introduzir o email',
            'password.required' => 'É obrigatório introduzir a password',
            'password.max:24' => 'A password tem de ter entre 8 a 24 carateres',
            'password.min:8' => 'A password tem de ter entre 8 a 24 carateres',
            'password_confirmation.required' => 'É obrigatório introduzir a confirmação de password',
            'password_confirmation.max:24' => 'A password tem de ter entre 8 a 24 carateres',
            'password_confirmation.min:8' => 'A password tem de ter entre 8 a 24 carateres',
            'password.confirmed' => 'As password têm de ser iguais',
        ]);



        $inputName = $request->input('name');
        $inputEmail= $request->input('email');
        $inputPassword= $request->input('password');
        $confirmPassword= $request->input('password_confirmation');

      return response()->json($inputName." ".$inputEmail." ".$inputPassword." ".$confirmPassword, 200);
    }

    public function permission(Request $request, User $user)
    {
        //dd($request['tipo']);
        $user->tipo = $request['tipo'];
        $user->save();
        return redirect()->route('Users')
            ->withPageTitle('Encomendas');
    }

    public function block(User $user)
    {
        if ($user->bloqueado == 1) {
            $user->bloqueado = 0;
        }
        else{
            $user->bloqueado = 1;
        }

        //dd($user->bloqueado);
        $user->save();
        return redirect()->route('Users')
            ->withPageTitle('Encomendas');
    }

    public function delete(User $user)
    {
        dd('Adieu');
    }
}
