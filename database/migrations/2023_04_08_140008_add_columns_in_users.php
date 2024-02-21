<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("url_facebook")->nullable();
            $table->string("url_google")->nullable();
            $table->string("url_linkedIn")->nullable();
            $table->string("url_twitter")->nullable();
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
            $table->dropColumn("url_facebook");
            $table->dropColumn("url_google");
            $table->dropColumn("url_linkedIn");
            $table->dropColumn("url_twitter");
        });
    }
}
