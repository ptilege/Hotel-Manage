<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultColumnToCurrencyPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('currency_property', function (Blueprint $table) {
            $table->boolean('default')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('currency_property', function (Blueprint $table) {
            $table->dropColumn([
                "default",
            ]);
        });
    }
}
