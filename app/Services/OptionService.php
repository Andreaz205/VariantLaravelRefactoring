<?php

namespace App\Services;

use App\Contracts\OptionServiceInterface;
use App\Models\Option;
use App\Models\OptionVariants;
use App\Models\Product;
use Illuminate\Support\Facades\Response;


class OptionService implements OptionServiceInterface
{
    public function isValidValueForOption(Option $option,  $value)
    {
        $optionValues = $option->values()->pluck('value')->toArray();
        foreach ($optionValues as $optionValue) {
            if ($value === $optionValue) {
                return false;
            }
        }
        return true;
    }

    public function checkValueValidation(Product $product, $value)
    {
        $productOptions = $product->options;
        foreach($productOptions as $productOption) {
            if (!$this->isValidValueForOption($productOption, $value)) {
                return false;
            }
        }
        return true;
    }

    public function checkTitleValidation(Product $product, $title)
    {
        $productOptions = $product->options;
        foreach($productOptions as $productOption) {
            if ($productOption->title === $title) {
                return false;
            }
        }

        return true;
    }
}
