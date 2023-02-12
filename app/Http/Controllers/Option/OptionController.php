<?php

namespace App\Http\Controllers\Option;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\OptionVariants;
use App\Models\Variant;
use App\Services\OptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class OptionController extends Controller
{
    protected $service;
    public function __construct(OptionService $OptionService)
    {
        $this->service = $OptionService;
    }

    public function store(Variant $variant, Request $request)
    {
        $validator = Validator::make($request->all(), [
           'title' => 'required|string',
           'value' => 'required|string',
        ]);
        if ($validator->fails()) {
            return Response::json(['error' => $validator->messages()], 422);
        }
        $data = $validator->validated();
        $product = $variant->product;

        if (!$this->service->checkTitleValidation($product, $data['title'])) {
            return Response::json(['error' => 'Title is already taken!'], 422);
        }
        if (!$this->service->checkValueValidation($product, $data['value'])) {
            return Response::json(['error' => 'Value is already taken!'], 422);
        }

        $productId = $product->id;
        $variantId = $variant->id;
        try {
            DB::beginTransaction();

            $option = Option::firstOrcreate([
                'product_id' => $productId,
                'variant_id' => $variantId,
                'title' => $data['title'],
            ]);

            OptionVariants::create([
                'option_id' => $option->id,
                'variant_id' => $variantId,
                'value' => $data['value']
            ]);

            Db::commit();
        } catch (\Exception $error) {
            DB::rollBack();
            return Response::json(['error' => $error], 500);
        }

        return $option;
    }

}
