<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarClassUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_class_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("class_register_id")->nullable()->comment("đăng ký thời gian dạy cho lớp");
            $table->unsignedBigInteger("user_id")->nullable()->comment("đăng ký thời gian dạy cho gia sư");
            $table->string("day")->comment("Thứ trong tuần");
            $table->timestamp("start_time")->comment("Giờ bắt đầu");
            $table->timestamp("end_time")->comment("Giờ kết thúc");
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
        Schema::dropIfExists('calendar_class_user');
    }
}
