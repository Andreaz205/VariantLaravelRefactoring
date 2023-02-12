<?php

namespace App\Contracts;

use App\Models\Option;
use App\Models\Product;

interface OptionServiceInterface
{
    public function isValidValueForOption(Option $option, $value);
    public function checkValueValidation(Product $product, $value);
    public function checkTitleValidation(Product $product, $title);
}
