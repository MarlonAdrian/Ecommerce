<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Auth;

class ProductOwnerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('can:manage-products');
    }

    public function products(){
        $products = Product::all();
        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_product' => ['required', 'string', 'min:3', 'max:35','unique:products'],
            'name_product' => ['required', 'string', 'min:3', 'max:35'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'stock' => ['required', 'numeric'],
            'path_image' => ['required', 'string'],
        ]);            

        $owner = Auth::user();
        $product = Product::create([
            'code_product' => $request['code_product'],
            'name_product' => $request['name_product'],
            'price' => $request['price'],
            'description' => $request['description'],
            'stock' => $request['stock'],
            'path_image' =>'https://picsum.photos/id/7/200/300',
            'user_id'=>1
        ]);        
        $owner->products()->save($product);
        return with(
            ['msg' => 'product_created']);   
    }
    
    public function edit(Request $request, $id){
        //input
        $request->validate([
            'code_product' => ['required', 'string', 'min:3', 'max:35','unique:products'],
            'name_product' => ['required', 'string', 'min:3', 'max:35'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'stock' => ['required', 'numeric'],
            'path_image' => ['required', 'string'],
        ]);   
        
        Product::where('id',$id)->update(
        [
            'code_product' => $request['code_product'],
            'name_product' => $request['name_product'],
            'price' => $request['price'],
            'description' => $request['description'],
            'stock' => $request['stock'],
            'path_image' => $request['path_image'],
        ]);
        return with(['message' => 'product_updated']);   
    }

    public function destroyProduct($id){
        Product::destroy($id);
        return with(
            ['msg' => 'product_removed']); 
    }     
}
