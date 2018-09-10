<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('changerequests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_type_id')->nullable()->unsigned();
            $table->integer('request_person_id')->nullable()->unsigned();
            $table->integer('subject_person_id')->nullable()->unsigned();
            $table->integer('item_id')->nullable()->unsigned();
            $table->date('date_originated')->nullable();
            $table->date('date_resolved')->nullable();
            $table->boolean('resolution')->nullable();
            $table->integer('resolved_by_id')->nullable()->unsigned();
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
        Schema::dropIfExists('changerequests');
    }
}
