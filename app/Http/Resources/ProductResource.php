<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            // 'code_product' => $this->code_product,
            'picture' => $this->image->path,                       
            'name_product' => $this->name_product,
            'description' => $this->description,
            'price' => $this->price,
            'name_commerce' => $this->commerce->name_commerce,
            'name_owner' => $this->commerce->user->getFullName(), 
        ]; 
    }
}
