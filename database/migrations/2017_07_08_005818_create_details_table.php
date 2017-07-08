<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ad_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('filter_id');
            $table->unsignedInteger('input_id');
            $table->string('value');
            $table->decimal('price', 8, 2)->nullable();
            $table->foreign('ad_id')->references('id')->on('ads');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('filter_id')->references('id')->on('filters');
            $table->foreign('input_id')->references('id')->on('inputs');
            $table->softDeletes();
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
        Schema::dropIfExists('details');
    }
}
