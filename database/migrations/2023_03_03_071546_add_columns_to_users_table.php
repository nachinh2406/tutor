<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->tinyInteger("gender")->nullable()->comment("1:Nam 2: Nữ 3: Bede");
            $table->timestamp("date_of_birth")->nullable();
            $table->string("school_name")->nullable();
            $table->string("major_name")->comment("Ngành học")->nullable();
            $table->timestamp("start_from")->nullable();
            $table->timestamp("end_from")->nullable();
            $table->string("verify_get_class_photo")->comment("Thẻ sinh viên")->nullable();
            $table->string("position")->comment("1: Giáo viên, 2: học sinh")->nullable();
            $table->string("is_experience")->comment("Có kinh nghiệm chưa")->nullable();
            $table->string("is_contract")->comment("Check kiểm tra đã đọc hợp đồng chưa")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
