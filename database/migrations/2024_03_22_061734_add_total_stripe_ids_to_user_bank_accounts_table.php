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
        Schema::table('user_bank_accounts', function (Blueprint $table) {
            $table->string('stripe_account_id')->nullable()->after('bank_routing_number');
            $table->string('stripe_bank_account_id')->nullable()->after('stripe_account_id');
            $table->string('stripe_external_account_id')->nullable()->after('stripe_bank_account_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_bank_accounts', function (Blueprint $table) {
            $table->dropColumn('stripe_account_id');
            $table->dropColumn('stripe_bank_account_id');
            $table->dropColumn('stripe_external_account_id');
        });
    }
};
