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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            // Verfied Check
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('identity_verified_at')->nullable();
            $table->timestamp('payment_verified_at')->nullable();
            // Address
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('image')->default('user.png');
            $table->string('cover')->default('cover.png');
            $table->text('about')->nullable();

            $table->string('company_name')->nullable();
            $table->string('designation')->nullable();
            $table->foreignId('language_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('role_id')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            //$table->double('balance')->default(0);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
