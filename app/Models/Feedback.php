<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    // Relación de uno a muchos
    //Un feedback le pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Relación de uno a muchos
    //Un feedback le pertenece a un producto         
    public function product()
    {
        return $this->belongsTo(Product::class);
    }      
}
