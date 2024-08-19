<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('property_id');
            $table->json('room_type_id');
            $table->json('meal_type_id');
            $table->json('bed_type_id');
            $table->integer('rate_id');
            $table->string('rate_type');
            $table->double('local_price')->nullable()->default(0);
            $table->double('foreign_price')->nullable()->default(0);
            $table->string('from_date');
            $table->string('to_date');
            $table->string('offer_code')->nullable();
            $table->integer('max_usage')->nullable()->default(0);
            $table->boolean('is_featured')->default(0);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('offers');
    }
}
