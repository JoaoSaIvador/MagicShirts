<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

use App\Models\Encomenda;
use App\Models\User;
use App\Models\Estampa;
use App\Models\Cor;

class PDFController extends Controller
{
    public function create_receipt(Request $request)
    {
        $encomenda = Encomenda::find($request->id);

        $listaTshirts = $encomenda->tshirts;
        $user = User::where('id', $encomenda->cliente_id)->value('name');

        foreach ($listaTshirts as $tshirt) {
            $listaEstampas[] = Estampa::where('id', $tshirt->estampa_id)->value('nome');
            $listaCores[] = Cor::where('codigo', $tshirt->cor_codigo)->value('nome');
        }

        $data = [
            'id'             => $encomenda->id,
            'user'           => $user,
            'nif'            => $encomenda->nif,
            'endereco'       => $encomenda->endereco,
            'tipo_pagamento' => $encomenda->tipo_pagamento,
            'ref_pagamento'  => $encomenda->ref_pagamento,
            'tshirts'        => $listaTshirts,
            'estampas'       => $listaEstampas,
            'cores'          => $listaCores,
            'preco_total' => $encomenda->preco_total

        ];

        //dd($data);

        $pdf = PDF::loadView('pdf.Receipt', $data);

        return $pdf->download('pdf.pdf');
        //return view('pdf.Receipt')->withData($data)
    }
}
