<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_detail_activities', function (Blueprint $table) {
            $table->id();
            $table->string('login_details_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamp('last_activity');
            $table->enum('is_type', ['no', 'yes'])->nullable();
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
        Schema::dropIfExists('login_detail_activities');
    }
};
