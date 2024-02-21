<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInClassUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_user', function (Blueprint $table) {
            $table->boolean("status")->comment("Trạng thái nhận lớp của user 0: đã hủy nhận lớp, 1: Đã nhận lớp");
            $table->boolean("is_email")->comment("Trạng thái nhận lớp của user 0: chưa gửi mail, 1: Đã gửi mail");
            $table->unsignedBigInteger("contract_id")->comment("Hợp đồng nhận lớp của gia sư");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_user', function (Blueprint $table) {
            $table->dropColumn("status");
            $table->dropColumn("is_email");
            $table->dropColumn("contract_id");
        });
    }
}
