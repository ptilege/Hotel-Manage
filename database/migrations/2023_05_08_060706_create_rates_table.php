<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('type');
            $table->bigInteger('property_id');
            $table->bigInteger('room_id');
            $table->bigInteger('bed_type_id');
            $table->bigInteger('meal_type_id');
            $table->string('price_per')->default('adult');
            $table->string('price_per_foreign')->default('adult');
            $table->double('price')->default(0);
            $table->double('price_extra_person')->default(0);
            $table->double('price_extra_child')->default(0);
            $table->date('from_date');
            $table->date('to_date');
            $table->bigInteger('base_rate_id')->nullable();
            // $table->boolean('is_holiday_rate')->default(0);
            // $table->boolean('is_weekend_rate')->default(0);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('rates');
    }
}
