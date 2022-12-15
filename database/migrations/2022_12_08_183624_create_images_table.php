<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            // Columnas para la tabla de la BDD
            $table->string('path');
            $table->morphs('imageable');
                        
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('images');
    }
};
