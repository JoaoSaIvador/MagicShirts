<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ColorPost;

use App\Models\Cor;

class ColorsController extends Controller
{
    public function index()
    {
        $cores = Cor::orderBy('nome')->withTrashed()->paginate(20);

        return view('admin.ColorManagement')
            ->withPageTitle('Cores')
            ->withCores($cores);
    }


    public function create()
    {
        $cor = new Cor();
        return view('colors.Create')
            ->withCor($cor);
    }

    public function edit(Cor $cor)
    {
        return view('colors.Edit')
            ->withCor($cor);
    }

    public function store(ColorPost $request)
    {
        $validated_data = $request->validated();

        $newCor = new Cor();
        $newCor->codigo = str_replace("#", "", $validated_data['codigo']);
        $newCor->nome = $validated_data['nome'];

        $newCor->save();

        return redirect()->route('Colors');
    }

    public function update(ColorPost $request, Cor $cor)
    {
        $validated_data = $request->validated();
        $cor->codigo = str_replace("#", "", $validated_data['codigo']);
        $cor->nome = $validated_data['nome'];

        $cor->save();
        return redirect()->route('Colors')
            ->with('alert-msg', 'Cor "' . $cor->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Cor $cor)
    {
        $oldName = $cor->nome;
        try {
            $cor->delete();

            return back()
                ->with('alert-msg', 'Cor "' . $oldName . '" foi apagada com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);
            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('admin.ColorManagement')
                    ->with('alert-msg', 'Não foi possível apagar a Cor "' . $oldName . '", porque esta cor já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('admin.ColorManagement')
                    ->with('alert-msg', 'Não foi possível apagar a Cor "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

    public function restore(Request $request)
    {
        //dd($request['cor']);
        $cor = Cor::withTrashed()->find($request['cor']);
        //dd($cor);
        try {
            $cor->restore();
            return back()
            ->with('alert-msg', 'Cor "' . $cor->name . '" foi restaurada com sucesso!')
            ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.ColorManagement')
            ->with('alert-msg', 'Não foi possível recuperar a Cor "' . $cor->name . '". Erro: ' . $th->errorInfo)
            ->with('alert-type', 'danger');
        }
    }
}
