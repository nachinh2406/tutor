<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_register', function (Blueprint $table) {
            $table->id();
            $table->string("code_class");
            $table->string("class_name");
            $table->integer("scope_class")->comment("phạm vi lớp");
            $table->unsignedBigInteger("province_id");
            $table->unsignedBigInteger("district_id");
            $table->unsignedBigInteger("ward_id");
            $table->float("price_class", 10,2)->comment("Giá lớp học");
            $table->integer("fee__percentage_class")->comment("Phí lớp học");
            $table->tinyInteger("number_lesson_week")->comment("Số lượng buổi học / tuần");
            $table->text("request_class")->nullable();
            $table->text("time_to_study")->nullable();
            $table->text("student_note")->nullable();
            $table->text("note")->nullable();
            $table->tinyInteger("status")->comment("1: Trạng thái chờ, 2: Trạng thái đang giao, 3: trạng thái đã giao, 4: trạng thái hủy");
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
        Schema::dropIfExists('class_register');
    }
}
