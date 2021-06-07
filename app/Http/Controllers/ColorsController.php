<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ColorPost;

use App\Models\Cor;

class ColorsController extends Controller
{
    public function index()
    {
        return view('home.dashboard')
            ->withPageTitle('Cores');
    }


    public function create()
    {
        $cor = new Cor();
        return view('Color.create')
            ->with($cor);
    }

    public function edit(Cor $cor)
    {
        return view('Color.edit')
            ->with($cor);
    }

    public function store(ColorPost $request)
    {
        $validated_data = $request->validated();
        $newCategoria = new Cor();
        $newCategoria->codigo = $validated_data['codigo'];
        $newCategoria->nome = $validated_data['nome'];

        $newCategoria->save();

        return redirect()->route('Color.view');
    }

    public function update(ColorPost $request, Cor $cor)
    {
        $validated_data = $request->validated();
        $cor->codigo = $validated_data['codigo'];
        $cor->nome = $validated_data['nome'];

        $cor->save();
        return redirect()->route('Catalogue')
            ->with('alert-msg', 'Estampa "' . $cor->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Cor $cor)
    {
        $oldName = $cor->nome;
        try {
            $cor->delete();

            return back()
                ->with('alert-msg', 'Estampa "' . $oldName . '" foi apagada com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);
            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('catalogue.Catalogue')
                    ->with('alert-msg', 'Não foi possível apagar a Estampa "' . $oldName . '", porque esta estampa já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('catalogue.Catalogue')
                    ->with('alert-msg', 'Não foi possível apagar a Estampa "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }
}
