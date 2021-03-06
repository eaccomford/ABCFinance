<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_notes', function (Blueprint $table) {
            $table->id();
            $table->integer('deposit_id');
            $table->integer('note');
            $table->integer('qty');
            $table->integer('createdby')->nullable()->useCurrent();
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
        Schema::dropIfExists('deposit_notes');
    }
}
