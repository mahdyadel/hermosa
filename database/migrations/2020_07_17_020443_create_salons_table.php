<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salons', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('lat');
            $table->string('lng');
            $table->string('main_photo')->nullable();
            $table->string('phone');
            $table->string('phone_2')->nullable();
            $table->string('bank_name');
            $table->string('bank_account_number');
            $table->string('bank_name_2')->nullable();
            $table->string('bank_account_number_2')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('commercial_register')->nullable();
            $table->boolean('is_active')->default(false);
            $table->double('percentage', 3, 1)->nullable();
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
        Schema::dropIfExists('salons');
    }
}
