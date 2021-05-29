<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('transaction_id')->unsigned();
            $table->bigInteger('equipment_id')->unsigned();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::table('transaction_items', function (Blueprint $table) {
            $table->foreign('transaction_id')
            ->references('id')
            ->on('transactions')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        Schema::table('transaction_items', function (Blueprint $table) {
            $table->foreign('equipment_id')
            ->references('id')
            ->on('equipments')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_items');
    }
}
