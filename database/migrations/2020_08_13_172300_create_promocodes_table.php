<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocodes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('percentage');
            $table->string('max_amount')->nullable();
            $table->integer('max_use')->nullable();
            $table->enum('owner_type', ['SALON', 'HERMOSA', 'BOTH']);
            $table->foreignId('salon_id')->nullable()->constrained('salons')->onDelete('cascade');
            $table->boolean('is_active');
            $table->date('expired_at');
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
        Schema::dropIfExists('promocodes');
    }
}
