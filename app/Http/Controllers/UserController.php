<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Models\Users;

class UserController extends Controller
{

    public function index()
    {
        return view('user.Login');
    }

    public function indexUsers(Request $request)
    {
        //dd($request->tipo);
        //$tipo;
        if (isset($request->tipo)) {
            $listaUsers = User::where('tipo', $request->tipo)->select('id', 'name', 'created_at', 'tipo', 'bloqueado', 'deleted_at')->withTrashed()->paginate(20);
        }
        else {
            $listaUsers = User::select('id', 'name', 'created_at', 'tipo', 'bloqueado', 'deleted_at')->withTrashed()->paginate(20);
        }

        return view('admin.UserManagement')
            ->withUsers($listaUsers);
    }

    public function registerPage()
    {
       echo(csrf_token());
        return view('user.Register');
    }

   

    public function edit(User $user)
    {
        $metodos = ['VISA', 'MC', 'PAYPAL'];
        //dd($user);
        return view('users.Profile')
            ->withPageTitle('Perfil')
            ->withUser($user)
            ->withMetodos($metodos);
    }

    public function permission(Request $request, User $user)
    {
        //dd($request['tipo']);
        $user->tipo = $request['tipo'];
        $user->save();
        return back();
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
        return back();
    }

    public function delete(User $user)
    {
        $oldUserName = $user->name;
        try {
            $user->delete();
            if (!is_null($user->foto_url)) {
                $oldFotoUrl = $user->foto_url;
                Storage::delete('public/fotos/' . $oldFotoUrl);
            }
            return back()
            ->with('alert-msg', 'Utilizador "' . $oldUserName . '" foi apagado com sucesso!')
            ->with('alert-type', 'success');

        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('admin.users')
                    ->with('alert-msg', 'Não foi possível apagar o Utilizador "' . $oldUserName . '", porque este utilizador já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('admin.users')
                    ->with('alert-msg', 'Não foi possível apagar o Utilizador "' . $oldUserName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

    public function restore(Request $request)
    {
        //dd($request['user']);
        $user = User::withTrashed()->find($request['user']);
        //dd($user);
        try {
            $user->restore();
            return back()
                ->with('alert-msg', 'Utilizador "' . $user->name . '" foi restaurada com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.ColorManagement')
                ->with('alert-msg', 'Não foi possível recuperar o Utilizador "' . $user->name . '". Erro: ' . $th->errorInfo)
                ->with('alert-type', 'danger');
        }
    }

    public function destroy_foto(User $user)
    {
        Storage::delete('public/fotos/' . $user->user->url_foto);
        $user->foto_url = null;
        $user->user->save();
        return redirect()->route('admin.users.edit', ['user' => $user])
            ->with('alert-msg', 'Foto do user "' . $user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }
}
