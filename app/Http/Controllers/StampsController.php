<?php

namespace App\Http\Controllers;

use App\Http\Requests\StampPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Estampa;
use App\Models\Categoria;
use App\Models\Cor;
use App\Models\Preco;

class StampsController extends Controller
{
    public function index()
    {
        $listaEstampas = Estampa::select('id', 'nome', 'categoria_id')->paginate(20);

        //dd(($listaEstampas[0]->categoria_id == $listaCategorias[4]->id) ? $listaCategorias[4]->nome : 'NO');

        return view('admin.StampsManagement')
            ->withEstampas($listaEstampas);
    }

    public function view_image(Estampa $estampa)
    {
        //dd($estampa->getImagemFullUrl());
        $path = storage_path('app/estampas_privadas/'. $estampa->imagem_url);
        return response()->file($path);
    }

    public function edit(Estampa $estampa)
    {
        $categorias = Categoria::pluck('nome', 'id');

        return view('Catalogue.edit')
            ->withEstampa($estampa)
            ->withCategorias($categorias);
    }
    public function create()
    {
        $estampa = new Estampa();
        $categorias = Categoria::pluck('nome', 'id');

        return view('Catalogue.create')
            ->withEstampa($estampa)
            ->withCategorias($categorias);
    }

    public function store(StampPost $request)
    {
        //dd($request);
        $validated_data = $request->validated();
        $newEstampa = new Estampa;
        $newEstampa->nome = $validated_data['nome'];

        if (auth()->user()->tipo == 'A') {
            $path = $validated_data['imagem_url']->store('public/estampas');
            $newEstampa->cliente_id = null;
            if ($request->has('categoria_id')) {
                $newEstampa->categoria_id = $validated_data['categoria_id'];
            }

            if ($request->has('descricao')) {
                $newEstampa->descricao = $validated_data['descricao'];
            }

            $newEstampa->imagem_url = basename($path);
            $newEstampa->save();
            return redirect()->route('Stamps')
                ->with('alert-msg', 'Estampa "' . $newEstampa->nome . '" foi criada com sucesso!')
                ->with('alert-type', 'success');
        }
        else if (auth()->user()->tipo == 'C') {
            $path = $validated_data['imagem_url']->store('estampas_privadas');
            $newEstampa->cliente_id = auth()->user()->id;

            if ($request->has('descricao')) {
                $newEstampa->descricao = $validated_data['descricao'];
            }

            $newEstampa->imagem_url = basename($path);
            $newEstampa->save();
            return redirect()->route('Catalogue.personal')
                ->with('alert-msg', 'Estampa "' . $newEstampa->nome . '" foi criada com sucesso!')
                ->with('alert-type', 'success');
        }
    }

    public function update(StampPost $request, Estampa $estampa)
    {
        $validated_data = $request->validated();
        $estampa->nome = $validated_data['nome'];

        if (auth()->user()->tipo == 'A') {
            Storage::delete('public/estampas/' . $estampa->imagem_url);
            $path = $validated_data['imagem_url']->store('public/estampas');
            if ($request->has('categoria_id')) {
                $estampa->categoria_id = $validated_data['categoria_id'];
            }

            if ($request->has('descricao')) {
                $estampa->descricao = $validated_data['descricao'];
            }

            $estampa->imagem_url = basename($path);
            $estampa->save();
            return redirect()->route('Stamps')
                ->with('alert-msg', 'Estampa "' . $estampa->nome . '" foi alterada com sucesso!')
                ->with('alert-type', 'success');
        }
        else if (auth()->user()->tipo == 'C'){
            Storage::delete('estampas_privadas' . $estampa->imagem_url);
            $path = $validated_data['imagem_url']->store('estampas_privadas');

            if ($request->has('descricao')) {
                $estampa->descricao = $validated_data['descricao'];
            }

            $estampa->imagem_url = basename($path);
            $estampa->save();
            return redirect()->route('Catalogue.personal')
                ->with('alert-msg', 'Estampa "' . $estampa->nome . '" foi alterada com sucesso!')
                ->with('alert-type', 'success');
        }

    }

    public function destroy(Estampa $estampa)
    {
        $oldName = $estampa->nome;
        $oldStampImage = $estampa->url_foto;
        try {
            $estampa->delete();
            if (auth()->user()->tipo == 'C') {
                Storage::delete('estampas_privadas' . $oldStampImage);
            }
            else{
                Storage::delete('public/estampas/' . $oldStampImage);
            }

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
