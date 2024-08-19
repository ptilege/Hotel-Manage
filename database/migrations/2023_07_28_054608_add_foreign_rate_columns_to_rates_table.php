<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Fortify\Fortify;


class AddForeignRateColumnsToRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rates', function (Blueprint $table) {
            $table->double('foreign_price')
                    ->after('price_extra_child')
                    ->default(0)
                    ->nullable();
                    
            $table->double('foreign_price_extra_person')
                    ->after('foreign_price')
                    ->default(0)
                    ->nullable();
                    
            $table->double('foreign_price_extra_child')
                    ->after('foreign_price_extra_person')
                    ->default(0)
                    ->nullable();

            // if (Fortify::confirmsTwoFactorAuthentication()) {
            //     $table->timestamp('two_factor_confirmed_at')
            //             ->after('two_factor_recovery_codes')
            //             ->nullable();
            // }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rates', function (Blueprint $table) {
            $table->dropColumn([
                "foreign_price",
                "foreign_price_extra_person",
                "foreign_price_extra_child",
            ]);  
        });
    }
}
