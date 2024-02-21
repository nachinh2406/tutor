<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("Tên trường");
            $table->string("code")->comment("Mã trường");
            $table->string("type")->comment("Loại trường");
            $table->string("province")->comment("Tỉnh thành");
            $table->tinyInteger("is_top")->default(0)->comment("Có phải trường top hay không ?");
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
        Schema::dropIfExists('schools');
    }
}
