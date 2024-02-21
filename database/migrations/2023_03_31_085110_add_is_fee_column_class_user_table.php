<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsFeeColumnClassUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_user', function (Blueprint $table) {
            $table->boolean("is_fee")->default(false)->after('file_contract')->comment("Kiểm tra đã đóng học phí chưa ?");
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
            $table->dropColumn("is_fee");
        });
    }
}
