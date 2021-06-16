<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use PDF;

use App\Models\Encomenda;
use App\Models\User;
use App\Models\Estampa;
use App\Models\Cor;

class PDFController extends Controller
{
    public function download_receipt(string $recibo)
    {
        return response()->download(storage_path('app/public/recibos/' . $recibo));
    }
}
