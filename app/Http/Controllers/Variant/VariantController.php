<?php

namespace App\Http\Controllers\Variant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class VariantController extends Controller
{
    public function store(Product $product)
    {
        $productId = $product->id;
        $variant = Variant::create(['product_id' => $productId]);
        return Response::json(['status' => 'success', 'variant' => $variant]);
    }

    public function index()
    {

    }
}
