<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomerAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('account');
            $table->float('amount')->nullable();
            $table->string('acc_number');
            $table->string('idcard');
            $table->integer('createdby')->nullable()->useCurrent();;
            $table->integer('modby')->nullable();
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
        Schema::dropIfExists('customer_accounts');
    }
}
