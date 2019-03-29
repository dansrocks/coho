<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNativeAttributeToClockTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clock_types', function (Blueprint $table) {
            $table->boolean('is_native')->default(false)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clock_types', function (Blueprint $table) {
            $table->dropColumn('is_native');
        });
    }
}
