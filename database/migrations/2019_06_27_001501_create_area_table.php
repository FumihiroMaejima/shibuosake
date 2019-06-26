<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area', function (Blueprint $table) {
            $table->integer('area_info_id')->comment('エリア情報ID');
            $table->string('areacode_m')->nullable()->comment('エリアMコード');
            $table->string('areaname_m')->nullable()->comment('エリアM名');
            $table->string('areacode_s')->nullable()->comment('エリアSコード');
            $table->string('areaname_s')->nullable()->comment('エリアS名');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area');
    }
}
