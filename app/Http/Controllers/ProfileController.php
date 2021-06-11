<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfilePost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $metodos = ['VISA', 'MC', 'PAYPAL'];

        return view('users.Profile')
            ->withPageTitle('Perfil')
            ->with('user', auth()->user())
            ->withMetodos($metodos);
    }

    public function edit(ProfilePost $request) {

        $request->validated();
        $user = auth()->user();

        $user->name = $request->nome;
        $user->email = $request->email;
        $user->cliente->nif = $request->nif;
        $user->cliente->endereco = $request->morada;
        $user->cliente->tipo_pagamento = $request->metodo_pagamento;
        $user->cliente->ref_pagamento = $request->ref_pagamento;

        if ($request->hasFile('foto')) {
            Storage::delete('public/fotos/' . $user->foto_url);
            $path = $request->foto->store('public/fotos');
            $user->foto_url = basename($path);
        }

        $user->save();
        $user->cliente->save();

        return back()
            ->with('alert-msg', "Informação atualizada com sucesso!")
            ->with('alert-type', 'success');
    }

    public function reset_password() {
        
        return view('auth.passwords.reset')
            ->withPageTitle('Password Reset');
    }

    public function destroy_foto()
    {
        $user = auth()->user();
        Storage::delete('public/fotos/' . $user->foto_url);
        $user->foto_url = null;
        $user->save();
        return back()
            ->with('alert-msg', "Informação atualizada com sucesso!")
            ->with('alert-type', 'success');
    }
}