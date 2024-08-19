<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_no');
            $table->integer('property_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->integer('max_adults')->default(0);
            $table->integer('max_child')->default(0);
            $table->integer('max_extra_beds')->default(0);
            $table->integer('quantity')->default(1);
            $table->integer('web_quantity')->default(1);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('rooms');
    }
}
