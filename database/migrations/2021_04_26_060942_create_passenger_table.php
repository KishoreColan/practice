<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passenger', function (Blueprint $table) {
            $table->id('passenger_id');
            $table->unsignedBigInteger('booking_id');
            $table->string('set_no');
            $table->timestamps();
            $table->foreign('booking_id')->references('id')->on('bus_booking');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passenger');
        Schema::dropForeign('passenger_booking_id_foreign');
    }
}
