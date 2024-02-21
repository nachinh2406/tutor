<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoUserColumnsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text("note_introduce")->nullable();
            $table->unsignedBigInteger("province_id")->nullable();
            $table->unsignedBigInteger("district_id")->nullable();
            $table->unsignedBigInteger("ward_id")->nullable();
            $table->string("address")->nullable();
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
            $table->dropColumn("note_introduce");
            $table->dropColumn("province_id");
            $table->dropColumn("district_id");
            $table->dropColumn("ward_id");
            $table->dropColumn("address");
        });
    }
}
