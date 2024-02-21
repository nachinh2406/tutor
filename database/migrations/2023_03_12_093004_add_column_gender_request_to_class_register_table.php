<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnGenderRequestToClassRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_register', function (Blueprint $table) {
            $table->tinyInteger("gender_request")->comment("1: Sinh viên nam, 2: Sinh viên nữ, 3: Giáo viên nữ, 4: Giáo viên nam, 5: Không yêu cầu");
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
            $table->dropColumn("gender_request");
        });
    }
}
