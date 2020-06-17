<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpectaclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spectacles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('rate')->nullable();
            $table->integer('duration')->nullable();
            $table->string('year')->nullable();
            $table->string('poster')->nullable();
            $table->string('trailer')->nullable();
            $table->string('slider_poster')->nullable();
            $table->integer('theater_id');
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
        Schema::dropIfExists('spectacles');
    }
}
