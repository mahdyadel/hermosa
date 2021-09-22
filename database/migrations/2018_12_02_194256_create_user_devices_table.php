<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_devices', function (Blueprint $table){
            $table->id();
            $table->string('unique_id');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->text('fcm_token')->nullable();
            $table->text('jwt_token')->nullable();
            $table->string('platform')->nullable();
            $table->double('app_version', 8, 2)->nullable();
            $table->timestamp('loggedin_at')->nullable();
            $table->timestamp('loggedout_at')->nullable();
            $table->unique(['unique_id', 'user_id']);
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
        Schema::dropIfExists('user_devices');
    }
}
