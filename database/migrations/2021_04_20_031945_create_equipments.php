<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('property_number', 30);
            $table->string('serial_number', 30);
            $table->string('description', 50);
            $table->string('unit_measure', 15);
            $table->decimal('unit_value')->nullable();
            $table->string('date_acquired')->nullable();
            $table->bigInteger('keyword_id')->unsigned();
            $table->string('status', 30);
            $table->string('qr_code', 10);
            $table->string('qrcode_file', 100)->nullable();
            $table->boolean('available')->default(true);
            $table->timestamps();
        });

        Schema::table('equipments', function (Blueprint $table) {
            $table->foreign('keyword_id')
            ->references('id')
            ->on('account_keywords')
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
        Schema::dropIfExists('equipments');
    }
}
