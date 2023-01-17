<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ClientProductResource;
use App\Http\Resources\FeedbackResource;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('getAll','showproducts');
    }

    /*-----SHOW ALL PRODUCT-----*/    
    public function showproducts(){
        $products = Product::all();
        return ProductResource::collection($products);
    }
    /*-----OBTAIN ALL MY PRODUCTS-----*/ 
    /*-----OBTAIN PRODUCT-----*/
    public function orderProduct(Request $request){
        $client = Auth::user();
        $request->validate([
            'name_product' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
        ]);   

        $order = ProductOrder::create([
            'name_product' => $request['name_product'],
            'user_id'=>Auth::user()->select('id')->pluck('id')->first(),
            'amount' => $request['amount'],
        ]);        
        $client->productorder()->save($order); 

        /*--Owner Contact--*/
        $product_byuser_id = Product::with('user')->where('name_product', $order->name_product)->select('user_id')->pluck('user_id')->first();
        $contact_owner = User::with('user')->where('id', $product_byuser_id)->select('personal_phone')->pluck('personal_phone')->first();
        
        return with(
            ['name_product' => $order->name_product,
            'amount' => $order->amount,
            'owner_contact' => $contact_owner]);
    }

    public function showMyProduct($id){   
        /*--Info my Order--- */     
        $product=new ClientProductResource(ProductOrder::findOrFail($id));

        /*---Contact Owner---*/
        $productOwner = ProductOrder::with('product')->where('id', $id)->select('name_product')->pluck('name_product')->first();
        $info_owner = Product::with('user')->where('name_product', $productOwner)->select('user_id')->pluck('user_id')->first();
        $contact_owner = User::with('user')->where('id', $info_owner)->select('personal_phone')->pluck('personal_phone')->first();

        return with(
            ['id_product'=>$id,
            'my_order'=>$product,
            'product_owner_contact' => $contact_owner]);
    }

    public function editOrderProduct(Request $request, $id){
        $user=Auth::user();
        $request->validate([
            'amount' => ['numeric'],
        ]); 

        ProductOrder::where('id',$id)->update(
            [
                'amount' => $request['amount'],
            ]);

        return with(['message' => 'modified']);  
    }

    /*-----FEEDBACK-----*/
    public function showfeedbacks(){
        $feedbacks = Feedback::all();
        return FeedbackResource::collection($feedbacks);
    }
    public function postfeedback(Request $request){
        $client = Auth::user();
        $request->validate([
            'product_id' => ['required', 'numeric'],
            'score' => ['required', 'string'],
            'comment' => ['required', 'string','unique:feedback', ],
        ]);   

        $feedback = Feedback::create([
            'product_id' => $request['product_id'],
            'score' => $request['score'],
            'comment' => $request['comment'],
            'user_id'=>Auth::user()->select('id')->pluck('id')->first()
        ]);        
        $client->feedback()->save($feedback);    
        
        return with(['message' => 'Feedback created']);        
    }
   
    public function editfeedback(Request $request, $id){
        $user=Auth::user();
        $request->validate([
            'product_id' => ['required','numeric'],
            'score' => ['string'],
            'comment' => [ 'string','unique:feedback'],
        ]);   
        
        Feedback::where('id',$id)->update(
        [
            'product_id' => $request['product_id'],
            'score' => $request['score'],
            'comment' => $request['comment'],
        ]);
      
        return with(['message' => 'Feedback modified']);         
    }    

    public function destroyfeedback($id){
        Feedback::destroy($id);
        return with(['message' => 'feedback_removed']); 
    }      
}