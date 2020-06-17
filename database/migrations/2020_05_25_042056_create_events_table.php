<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->dateTime('dated_at')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_premiere')->nullable();
            $table->boolean('is_chosen_for_main_page')->nullable();
            $table->integer('available_seats_number')->nullable();
            $table->integer('theater_id')->nullable();
            $table->integer('spectacle_id')->nullable();
            $table->integer('hall_id')->nullable();
            $table->string('genre')->nullable();
            $table->integer('age')->nullable();
            $table->integer('price')->nullable();
            $table->integer('duration')->nullable();
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
        Schema::dropIfExists('events');
    }
}
