<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsCalendarClassRegister extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_register', function (Blueprint $table) {
            $table->boolean("is_calendar")->nullable()->after("is_university_top");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_register', function (Blueprint $table) {
            $table->dropColumn("is_calendar");
        });
    }
}
