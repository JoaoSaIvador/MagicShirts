<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estampa;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $carrinho = $request->session()->get('carrinho', []);

        return view('checkout.Checkout')
            ->withPageTitle('Checkout')
            ->with('carrinho', session('carrinho'));
    }
}