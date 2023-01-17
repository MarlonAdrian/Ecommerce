<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'owner_personal_phone',
        'received',
        'product_id',
        'user_address',
        'amount',
        'name_product',
    ];  
    
    //Relación de uno a muchos
    public function user()
    {
        return $this->belongsTo(User::class);
    }      
    
    public function product()
    {
        return $this->hasOne(Product::class);
    }    
}
