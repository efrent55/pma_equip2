<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('sn', 5)->nullable();
            $table->string('firstname', 50);
            $table->string('middlename', 30)->nullable();
            $table->string('lastname', 30);
            $table->string('extname', 10)->nullable();
            $table->string('gender', 6)->nullable();
            $table->string('picture', 200)->nullable();
            $table->string('profile_type', 10)->nullable();
            $table->string('birthdate')->nullable();
            $table->string('coy', 1)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('profiles');
    }
}
