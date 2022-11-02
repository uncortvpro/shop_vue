<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_variations', function (Blueprint $table) {

            $table->id();
            $table->string('title');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('parent_variations')->unsigned()->nullable();
            $table->string('template')->nullable();
            $table->timestamps();
            $table->foreign('parent_variations')->references('id')->on('category_variations')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_variations');
    }
}
