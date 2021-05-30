<?php

namespace App\Http\Controllers;

use App\Http\Requests\StampPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Estampa;
use App\Models\Categoria;
use App\Models\Cor;
use App\Models\Preco;

class CatalogueController extends Controller
{
    public function index(Request $request)
    {
        $listaCategorias = Categoria::pluck('nome', 'id');
        $categoria = $request->query('categoria_id', null);

        $listaEstampas = Estampa::where('categoria_id', $categoria)->whereNull('cliente_id')->paginate(9);

        //dd($precoEstampa->preco_un_catalogo);
        return view('catalogue.Catalogue')
            ->withPageTitle('Catalogo')
            ->withEstampas($listaEstampas)
            ->withCategoria($categoria)
            ->withCategorias($listaCategorias);
    }

    public function view_product(Estampa $estampa)
    {
        $listaCores = Cor::pluck('nome', 'codigo');
        $precoEstampa = Preco::find(1);
        $listaTamanhos = ['XS', 'S', 'M', 'L', 'XL'];
        $categoria = Categoria::where('id', $estampa->categoria_id)->value('nome');

        if (is_null($categoria)) {
            $categoria = "Sem Categoria";
        }

        return view('catalogue.Product')
            ->withPageTitle('Produto')
            ->withEstampa($estampa)
            ->withCores($listaCores)
            ->withTamanhos($listaTamanhos)
            ->withPreco($precoEstampa)
            ->withCategoria($categoria);
    }

    public function edit(Estampa $estampa)
    {
        return view('Catalogue.edit')
            ->withEstampa($estampa);
    }
    public function create()
    {
        $estampa = new Estampa();
        return view('Catalogue.create')
            ->withEstampa($estampa);
    }

    public function store(StampPost $request)
    {
        //dd($request->has('descricao'));
        $validated_data = $request->validated();
        $newEstampa = new Estampa;
        $newEstampa->nome = $validated_data['nome'];
        if ($request->has('descricao')) {
            $newEstampa->descricao = $validated_data['descricao'];
        }
        $path = $request->imagem_url->store('public/estampas');
        $newEstampa->imagem_url = basename($path);
        //$newEstampa->cliente_id = auth()->user()->id;
        $newEstampa->save();
        return redirect()->route('Catalogue')
            ->with('alert-msg', 'Estampa "' . $newEstampa->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(StampPost $request, Estampa $estampa)
    {
        $validated_data = $request->validated();
        $estampa->nome = $validated_data['nome'];
        if ($request->has('descricao')) {
            $estampa->descricao = $validated_data['descricao'];
        }
        Storage::delete('public/estampas/' . $estampa->imagem_url);
        $path = $request->imagem_url->store('public/estampas');
        $estampa->imagem_url = basename($path);
        $estampa->save();
        return redirect()->route('Catalogue')
            ->with('alert-msg', 'Estampa "' . $estampa->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Estampa $estampa)
    {
        $oldName = $estampa->nome;
        try {
            $estampa->delete();
            return redirect()->route('catalogue.Catalogue')
                ->with('alert-msg', 'Estampa "' . $estampa->nome . '" foi apagada com sucesso!')
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
