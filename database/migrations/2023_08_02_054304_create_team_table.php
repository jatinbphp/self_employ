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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            
            $table->string('brand')->nullable();
            $table->string('name')->nullable();
            
            $table->foreignId('owner_id')->nullable();
            $table->string('job_complete')->default('0');
            $table->string('rating')->nullable();
            $table->string('on_time')->nullable();
            $table->string('on_budget')->nullable();
            $table->string('repeat_hire')->nullable();
            $table->string('image')->default('user.png');
            $table->string('cover')->default('cover.png');

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
        Schema::dropIfExists('teams');
    }
};
