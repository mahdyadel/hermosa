<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salon_id')->constrained('salons')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('service_type', ['SALON_SERVICE', 'HOME_SERVICE']);
            $table->enum('status', ['PENDING', 'WAITING_PAYMENT', 'ACCEPTED', 'FINISHED', 'CANCELLED']);
            $table->enum('payment_status', ['UNPAID', 'PAID', 'PARTIALLY_PAID', 'REFUNDED', 'PARTIALLY_REFUNDED']);
            $table->foreignId('payment_type_id')->constrained('payment_types')->onDelete('cascade');
            $table->foreignId('promocode_id')->nullable()->constrained('promocodes')->onDelete('cascade');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();

            $table->enum('discount_owner', ['SALON', 'HERMOSA', 'BOTH'])->nullable();
            $table->string('fixed_price');  // 200 RSA
            $table->string('discount_amount'); // 20 RSA
            $table->string('discounted_price'); // 180 RSA
            $table->string('home_service_fees'); // 40RSA
            $table->string('tax_amount'); // 36 RSA
            $table->string('final_price');  // 256 RSA

            $table->string('salon_profit_amount'); // 90% - 248.4 RSA
            $table->string('hermosa_profit_amount'); // 10% -  27.6 RSA
            $table->string('hermosa_tax_amount'); // 4.14 RSA
            $table->string('hermosa_profitـamount_after_tax'); // 23.46 RSA
            $table->string('charity_amount'); // 10% - 2.346 RSA
            $table->string('zakat_amount'); // 40% - 9.384 RSA
            $table->string('hermosa_final_profit_amount'); // 11.73 RSA

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
        Schema::dropIfExists('reservations');
    }
}
