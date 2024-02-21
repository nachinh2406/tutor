<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsForClassRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_register', function (Blueprint $table) {
            $table->tinyInteger("is_experienced")->nullable()->comment("Yêu cầu đã có kinh nghiệm đi dạy");
            $table->tinyInteger("is_university_top")->nullable()->comment("Yêu cầu sinh viên trường top đầu");
            $table->tinyInteger("role_user")->nullable()->comment("Vai trò người dậy: Có thể là sinh viên năm 1, năm 2, năm 3,...");
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
            $table->dropColumn("is_experienced");
            $table->dropColumn("is_university_top");
            $table->dropColumn("role_user");
        });
    }
}
