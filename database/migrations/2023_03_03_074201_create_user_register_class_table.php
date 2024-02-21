<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRegisterClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_register_class', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("class_register_id");
            $table->unsignedBigInteger("user_id");
            $table->tinyInteger("status")->default(1)->comment("1: note nhận lớp, 2: đã nhận lớp");
            $table->tinyInteger("is_email_note")->nullable()->comment("mail lúc nhận lớp: 1: chưa gửi 2: đã gửi");
            $table->tinyInteger("is_email_confirm_class")->nullable()->comment("mail lúc nhận lớp thành công hoặc thất bại: 1: chưa gửi 2: đã gửi");
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
        Schema::dropIfExists('user_register_class');
    }
}
