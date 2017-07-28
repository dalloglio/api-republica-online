<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('zip_code', 8);
            $table->string('street');
            $table->string('number', 20);
            $table->string('sub_address')->nullable();
            $table->string('neighborhood');
            $table->string('country')->nullable();
            $table->string('state_initials')->nullable();
            $table->string('state');
            $table->string('city');
            $table->unsignedInteger('state_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->enum('show_on_map', \App\Domains\Address\Address::keys())->default(0);
            $table->nullableMorphs('addressable');
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
        Schema::dropIfExists('addresses');
    }
}
