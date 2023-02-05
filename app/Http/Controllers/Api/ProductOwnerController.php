<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Commerce;
use App\Models\User;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;

class ProductOwnerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('can:manage-products');
        $this->middleware('can:manage-commerces');
    }

/*-----MYCOMMERCE----*/
    public function myCommerceName(Request $request){
        $owner = Auth::user();
        $request->validate([
            'name_commerce' => ['required', 'string', 'min:10', 'max:300','unique:commerces'],
            'user_id'=>['unique:commerces']
        ]);            

        $commerce = Commerce::create([
            'name_commerce' => $request['name_commerce'],
            'user_id'=>Auth::user()->select('id')->pluck('id')->first()
        ]);        
        $owner->commerces()->save($commerce);
        return with(
            ['msg' => 'commerce_created',
              'your_id_commerce'=>$commerce->id]);   
    }

    public function editCommerceName(Request $request, Commerce $id){
        if(Auth::user()->id == $id->user_id){
            $request->validate([
                'name_commerce' => ['required', 'string', 'min:10', 'max:300','unique:commerces'],
            ]); 
            $id->update(['name_commerce' => $request['name_commerce']]);
                return Response::allow('Name Commerce updated');
        }else {
            return Response::deny('You do not own this commerce.');
        }

    }

    public function MyIdCommerce(){
        $mycommerce = Commerce::whereHas(
            'user', function($q){
                $q->where('user_id', Auth::user()->id);
            }
        )->first();
        return with([
            'MyCommerceID'=>$mycommerce->id,
            'MyCommerceName'=>$mycommerce->name_commerce,
            ]);
    }
/*---MY PRODUCTS---*/    
    public function publishedProducts(){
        $my_products = Product::whereHas(
            'user', function($q){
                $q->where('user_id', Auth::user()->id);
            }
        )->get();
        return with([
            'published_products'=>ProductResource::collection($my_products)]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_product' => ['required', 'string', 'min:10', 'max:20','unique:products'],
            'name_product' => ['required', 'string', 'min:10', 'max:200'],
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
            'path_image' =>$request['path_image'],
            'user_id'=>1
        ]);        
        $owner->products()->save($product);
        return with(
            ['msg' => 'product_created']);   
    }
    
    public function edit(Request $request, Product $id){
        if(Auth::user()->id == $id->user_id){
            //input
            $request->validate([
                'code_product' => ['required', 'string', 'min:3', 'max:35','unique:products'],
                'name_product' => ['required', 'string', 'min:3', 'max:35'],
                'price' => ['required', 'numeric'],
                'description' => ['required', 'string'],
                'stock' => ['required', 'numeric'],
                'path_image' => ['required', 'string'],
            ]);  

            $id->update(
            [
                'code_product' => $request['code_product'],
                'name_product' => $request['name_product'],
                'price' => $request['price'],
                'description' => $request['description'],
                'stock' => $request['stock'],
                'path_image' => $request['path_image'],
            ]);
            return Response::allow('Product updated');
        } else{
            return Response::deny('You do not own this product.');
        }       
    }
    public function destroyProduct(Product $id){
        if(Auth::user()->id == $id->user_id){
            Product::destroy($id->id);
            return with(['message' => 'product_removed']);
        } else{
            return Response::deny('You do not own this product');
        }         
    }     
}
