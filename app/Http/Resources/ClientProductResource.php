<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;

class ClientProductResource extends JsonResource
{
    public function toArray($request)
    {
        $users = Product::all();
        return [                      
            'name_product' => $this->name_product,
            'amount' =>$this->amount,
        ]; 
    }
}
