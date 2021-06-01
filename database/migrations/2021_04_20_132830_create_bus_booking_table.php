<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_id');          
            $table->string('user_id');
            $table->integer('seats_booked');
            $table->string('total_price');
            $table->enum('booking_status', ['0','1','2'])->comment('0 -Failed, 1-Pending, 2-completed');
            $table->timestamps();

            $table->foreign('bus_id')->references('id')->on('buses'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_booking');
        Schema::dropForeign('bus_booking_bus_id_foreign');
    }
}
