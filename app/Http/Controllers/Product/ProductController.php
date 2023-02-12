<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function store()
    {
        $title = 'some title';
        $product = Product::create(['title' => $title]);
        return Response::json(['status' => 'success', 'product' => $product]);
    }
}
