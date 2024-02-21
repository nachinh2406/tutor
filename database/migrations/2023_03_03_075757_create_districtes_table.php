<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districtes', function (Blueprint $table) {
            $table->integerIncrements("id");
            $table->string("name");
            $table->string("type")->comment("Quận, huyện hoặc thành phố");
            $table->unsignedInteger("matp");
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
        Schema::dropIfExists('districtes');
    }
}
