<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('companie_id')->unsigned();
            $table->string('product_name');
            $table->integer('price');
            $table->integer('stock');
            $table->string('comment')->nullable();
            $table->string('img_path');
            $table->timestamps();

            $table->foreign('companie_id')->references('id')->on('companies')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
        Schema::dropIfExists('products');
    }
};
