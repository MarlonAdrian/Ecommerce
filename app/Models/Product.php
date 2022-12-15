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
        'commerce_id'
    ];

    // Relación de uno a muchos
    //Un producto puede estar en varios negocios
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

    // Relación polimórfica uno a uno
    // Un producto puede tener una imagen    
    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
}
