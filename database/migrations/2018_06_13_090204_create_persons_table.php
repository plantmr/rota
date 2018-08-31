<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');           
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('user_name', 255);
            $table->string('password', 255);
            $table->integer('levels_id')->unsigned();
            $table->boolean('active')->default(false);
            $table->boolean('first_login')->default(false);
            $table->string('email', 250)->unique()->default(null);
            $table->string('tel_num', 255);
            $table->string('mobile', 255);
            $table->string('address', 255);
            $table->text('notes');
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
        Schema::dropIfExists('persons');
    }
}
