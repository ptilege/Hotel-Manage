<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('booking_id');
            $table->integer('room_id');
            $table->integer('meal_type');
            $table->integer('bed_type');
            $table->integer('qty');
            $table->integer('extra_child');
            $table->integer('extra_beds');
            $table->double('partial_amount')->default(0)->nullable();
            $table->double('total_amount')->default(0);
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
        Schema::dropIfExists('booking_items');
    }
}
