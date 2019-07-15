<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->integer('category_info_id')->comment('カテゴリー情報ID');
            $table->string('category_l_code')->nullable()->comment('大業態コード');
            $table->string('category_l_name')->nullable()->comment('大業態名称');
            $table->string('category_code_s')->nullable()->comment('小業態コード');
            $table->string('category_name_s')->nullable()->comment('小業態名称');
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
        Schema::dropIfExists('category');
    }
}
