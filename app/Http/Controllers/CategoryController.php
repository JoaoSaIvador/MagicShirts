<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryPost;

use App\Models\Categoria;

class CategoryController extends Controller
{
    public function index()
    {
        return view('home.dashboard')
            ->withPageTitle('Categorias');
    }


    public function create()
    {
        $categoria = new Categoria();
        return view('Category.create')
            ->with($categoria);
    }

    public function edit(Categoria $categoria)
    {
        return view('Category.edit')
            ->with($categoria);
    }

    public function store(CategoryPost $request)
    {
        $validated_data = $request->validated();
        $newCategoria = new Categoria();
        $newCategoria->nome = $validated_data['nome'];

        $newCategoria->save();

        return redirect()->route('Category.view');
    }

    public function update(CategoryPost $request, Categoria $categoria)
    {
        $validated_data = $request->validated();
        $categoria->nome = $validated_data['nome'];

        $categoria->save();
        return redirect()->route('Catalogue.view')
            ->with('alert-msg', 'Estampa "' . $categoria->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Categoria $categoria)
    {
        $oldName = $categoria->nome;
        try {
            $categoria->delete();

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
