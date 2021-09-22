<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade');
            $table->foreignId('salon_service_id')->constrained('salon_services')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->date('date');
            $table->time('time');

            $table->enum('discount_owner', ['SALON', 'HERMOSA', 'BOTH']);
            $table->string('fixed_price');
            $table->string('discount_amount');
            $table->string('discounted_price');
            $table->string('home_service_fees');
            $table->string('tax_amount');
            $table->string('final_price');

            $table->string('salon_profit_amount');
            $table->string('hermosa_profit_amount');
            $table->string('hermosa_tax_amount');
            $table->string('hermosa_profit_amount_after_tax');
            $table->string('charity_amount');
            $table->string('zakat_amount');
            $table->string('hermosa_final_profit_amount');
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
        Schema::dropIfExists('reservation_services');
    }
}
