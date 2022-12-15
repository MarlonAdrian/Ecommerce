<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commerce extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_commerce'
    ]; 
    // Relación de uno a muchos 
    //Un negocio puede tener muchos productos
    public function products()
    {
        return $this->hasMany(Product::class);
    }    
}
