<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('vehicle_id')->unsigned();
            $table->string('payment_id')->nullable();
            $table->integer('picking_location_id')->unsigned();
            $table->integer('dropping_location_id')->unsigned()->nullable();
            $table->datetime('start_from');
            $table->datetime('finish_date');
            $table->double('subtotal')->default(0.00);
            $table->double('discount')->default(0.00);
            $table->double('airport_fee')->default(0.00);
            $table->double('different_location_fee')->default(0.00);
            $table->double('total')->default(0.00);
            $table->integer('promo')->default(0);
            $table->integer('days')->default(0);
            $table->integer('hours')->default(0);
            $table->boolean('is_payed')->default(false);
            $table->boolean('is_confirmed')->default(false);
            $table->boolean('cancelled')->default(false);
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
        Schema::dropIfExists('bookings');
    }
}
