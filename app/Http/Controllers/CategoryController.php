<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryPost;

use App\Models\Categoria;

class CategoryController extends Controller
{
    public function index()
    {
        $categorias = Categoria::select('id', 'nome', 'deleted_at')->withTrashed()->paginate(20);

        return view('admin.CategoryManagement')
            ->withCategorias($categorias);
    }


    public function create()
    {
        $categoria = new Categoria();
        return view('categories.Create')
            ->withCategoria($categoria);
    }

    public function edit(Categoria $categoria)
    {
        return view('categories.Edit')
            ->withCategoria($categoria);
    }

    public function store(CategoryPost $request)
    {
        $validated_data = $request->validated();
        $newCategoria = new Categoria();
        $newCategoria->nome = $validated_data['nome'];

        $newCategoria->save();

        return redirect()->route('Categories');
    }

    public function update(CategoryPost $request, Categoria $categoria)
    {
        $validated_data = $request->validated();
        $categoria->nome = $validated_data['nome'];

        $categoria->save();
        return redirect()->route('Categories')
            ->with('alert-msg', 'Categoria "' . $categoria->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Categoria $categoria)
    {
        $oldName = $categoria->nome;
        try {
            $categoria->delete();

            return back()
                ->with('alert-msg', 'Categoria "' . $oldName . '" foi apagada com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);
            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('Categories')
                    ->with('alert-msg', 'Não foi possível apagar a Categoria "' . $oldName . '", porque esta categoria já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('Categories')
                    ->with('alert-msg', 'Não foi possível apagar a Categoria "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

    public function restore(Request $request)
    {
        //dd($request['categoria']);
        $categoria = Categoria::withTrashed()->find($request['categoria']);
        //dd($categoria);
        try {
            $categoria->restore();
            return back()
                ->with('alert-msg', 'Categoria "' . $categoria->nome . '" foi restaurada com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            //throw $th;
            return back()
                ->with('alert-msg', 'Não foi possível recuperar a Categoria "' . $categoria->nome . '". Erro: ' . $th->errorInfo)
                ->with('alert-type', 'danger');
        }
    }
}
