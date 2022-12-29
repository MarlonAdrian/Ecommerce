<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductOwnerController extends Controller
{
    public function products(){
        $products = Product::all();
        return ProductResource::collection($products);
    }
}
