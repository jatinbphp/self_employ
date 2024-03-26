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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->date('date')->nullable();
            $table->date('beforedate')->nullable();
            $table->boolean('is_flexible')->default(false);
            $table->boolean('certain_time')->default(false);
            $table->string('flexible_time_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('budget_id')->nullable();
            $table->foreignId('user_id')->nullable();
            // Address
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();

            $table->text('description')->nullable();
            $table->double('amount', 8, 2);
            $table->enum('status', ['active', 'inactive', 'done', 'progress', 'awarded'])->default('active');
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
        Schema::dropIfExists('posts');
    }
};
