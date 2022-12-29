<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            //ID for BDD
            $table->id();
            //Product's Code
            $table->string('code_product')->unique();
            //Product's name
            $table->string('name_product',200);
            //Product's Price
            $table->decimal('price', 8, 2);
            //Product's Description
            $table->string('description')->nullable();
            //Product's Stock
            $table->string('stock');
            //Product's State
            $table->boolean('state')->default(true);


           //Un producto puede estar en varios negocios y 
           //Un negocio puede tener muchos productos
           $table->unsignedBigInteger('commerce_id');
           $table->foreign('commerce_id')
                ->references('id')
                ->on('commerces')
                ->onDelete('cascade')
                ->onUpdate('cascade');     

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
