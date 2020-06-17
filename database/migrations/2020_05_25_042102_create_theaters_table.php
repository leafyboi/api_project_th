<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheatersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theaters', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('photo')->nullable();
            $table->string('preview')->nullable();
            $table->string('cash_desk_phone_number')->nullable();
            $table->string('phone_number_for_reference')->nullable();
            $table->text('contacts')->nullable();
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
        Schema::dropIfExists('theaters');
    }
}
