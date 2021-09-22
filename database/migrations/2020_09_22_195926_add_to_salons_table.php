<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToSalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salons', function (Blueprint $table) {
            $table->string('logo')->nullable();
            $table->string('bank_account_number_pdf')->nullable();
            $table->string('bank_account_number_2_pdf')->nullable();
            $table->string('tax_number_pdf')->nullable();
            $table->string('commercial_register_pdf')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salons', function (Blueprint $table) {
            //
        });
    }
}
