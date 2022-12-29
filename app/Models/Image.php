<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $fillable = [
        'path',
    ];

    use HasFactory;

    // Relación polimórfica uno a uno
    // Una imagen le pertenece a un usuario, producto
    public function imageable()
    {
        return $this->morphTo();
    }

 
    public function getUrl(): string
    {
        return Str::startsWith($this->path, 'https://')
            ? $this->path
            : Storage::url($this->path);
    }
}
