<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeClocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeclocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('fk_user_id');
            $table->string('type', 10);
            $table->date('date');
            $table->time('clockin');
            $table->time('clockout')->nullable()->default(null);
            $table->unsignedInteger('duration')->default(0);
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
        Schema::dropIfExists('timeclocks');
    }
}
