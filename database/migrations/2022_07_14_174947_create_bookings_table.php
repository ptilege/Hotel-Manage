<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('property_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('address');
            $table->string('country');
            $table->string('city');
            $table->string('nic');
            $table->string('mobile');
            $table->string('checkin_date');
            $table->string('checkout_date');
            $table->integer('offer_id')->nullable();
            $table->integer('coupon_id')->nullable();
            $table->decimal('total_amount')->default(0);
            $table->decimal('patial_amount')->default(0);
            $table->decimal('total_tax')->default(0);
            $table->enum('status', ['confirm', 'cancel', 'reject', 'fail', 'pending'])->default('pending');
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
