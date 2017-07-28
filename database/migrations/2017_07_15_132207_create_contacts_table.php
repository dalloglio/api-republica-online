<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 11)->nullable();
            $table->string('cellphone', 11)->nullable();
            $table->string('whatsapp', 11)->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('subject')->nullable();
            $table->string('role')->nullable();
            $table->text('about')->nullable();
            $table->text('message')->nullable();
            $table->nullableMorphs('contactable');
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
        Schema::dropIfExists('contacts');
    }
}
