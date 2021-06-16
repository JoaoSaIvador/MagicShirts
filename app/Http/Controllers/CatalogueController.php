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

class CatalogueController extends Controller
{
    public function index(Request $request)
    {
        $listaCategorias = Categoria::pluck('nome', 'id');
        $categoria = $request->query('categoria_id', null);
        if($request->has('Search'))
        {
            $listaEstampas = Estampa::where('nome','like', '%'.$request->input('Search').'%')
            ->orWhere('descricao','like', '%'.$request->input('Search').'%')->select('id', 'nome', 'imagem_url', 'cliente_id')->paginate(9);
        }
        else{
            $listaEstampas = Estampa::where('categoria_id', $categoria)->select('id', 'nome', 'imagem_url', 'cliente_id')->paginate(9);
        }
        

        return view('catalogue.Catalogue')
            ->withPageTitle('Catalogo')
            ->withEstampas($listaEstampas)
            ->withCategoria($categoria)
            ->withCategorias($listaCategorias);
    }

    public function view_personal()
    {

        //dd(Auth::user()->id);
        $userId = Auth::user()->id;
        $listaEstampas = Estampa::where('cliente_id', $userId)->select('id', 'nome', 'imagem_url', 'cliente_id')->paginate(9);

        return view('catalogue.Personal')
            ->withPageTitle('Catalogo Pessoal')
            ->withEstampas($listaEstampas);
    }

    public function view_product(Estampa $estampa)
    {
        $listaCores = Cor::pluck('nome', 'codigo');
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
            ->withCategoria($categoria);
    }
}
