<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'code_product',
        'name_product',
        'price',
        'description',
        'stock',
        'path_image'
    ];

    // Relación de uno a muchos
    //Un producto puede estar en varios negocios
    /**modificado por la eliminacion de la columna commerce de la tabla productos */
    public function commerce()
    {
        return $this->belongsTo(Commerce::class);
    }    

    // Relación de uno a muchos
    //Un producto puede tener muchos feedback
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    //Relación de uno a muchos
    public function user()
    {
        return $this->belongsTo(User::class);
    }  

    public function productorder()
    {
        return $this->belongsTo(ProductOrder::class);
    }      
}
