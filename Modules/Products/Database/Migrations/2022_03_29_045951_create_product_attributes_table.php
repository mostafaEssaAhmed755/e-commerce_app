<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->decimal('price')->nullable();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('attribute_id')->constrained();
            $table->foreignId('attribute_value_id')->constrained();
            $table->unique(['product_id', 'attribute_id', 'attribute_value_id'], 'product_attribute_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attributes');
    }
}
