<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->string('name');
            $table->string('slug')->default('');
            $table->string('components');
            $table->string('image')->default('');
            $table->mediumText('description');
            $table->string('price');
            $table->string('vat')->default('0');
            $table->unsignedInteger('is_offer')->default(0);
            $table->unsignedInteger('is_special')->default(0);
            $table->unsignedInteger('status')->default(1);
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
        Schema::dropIfExists('foods');
    }
}
