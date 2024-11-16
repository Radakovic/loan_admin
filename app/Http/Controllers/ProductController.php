<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Auth::user()?->products()->get();

        return view('product.index', compact('products'));
    }
}
