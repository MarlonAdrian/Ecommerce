<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->id();

            $table->boolean('received')->default(1);//1=received, 0=noreceived

           //Un producto puede estar varios usuarios y 
           //Un usuario puede tener muchos productos
           $table->unsignedBigInteger('user_id');
           $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');    


           $table->string('name_product');
           $table->foreign('name_product')
                ->references('name_product')
                ->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');    


           $table->integer('amount')->default(1);//by default will be 1                     
           $table->timestamps();
        });
    }


    
    public function down()
    {
        Schema::dropIfExists('product_orders');
    }
};
