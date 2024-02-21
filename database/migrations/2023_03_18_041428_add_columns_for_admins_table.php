<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsForAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string("phone")->nullable();
            $table->string("address")->nullable();
            $table->string("zip_code")->nullable();
            $table->tinyInteger("gender")->nullable()->comment("1: Nam, 2: Nữ, 3: Khác");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn("phone");
            $table->dropColumn("address");
            $table->dropColumn("zip_code");
            $table->dropColumn("gender");
        });
    }
}
