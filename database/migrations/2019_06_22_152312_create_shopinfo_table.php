<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopinfo', function (Blueprint $table) {
            $table->integer('info_id')->comment('情報ID');
            $table->string('shop_id')->comment('店舗ID');
            $table->string('shop_update_date')->comment('店舗更新日時');
            $table->string('name')->comment('店舗名');
            $table->string('latitude')->nullable()->comment('緯度');
            $table->string('longitude')->nullable()->comment('経度');
            $table->string('category')->nullable()->comment('カテゴリー');
            $table->string('url')->nullable()->comment('URL');
            $table->string('url_mobile')->nullable()->comment('モバイル版URL');
            $table->string('coupon_url_pc')->nullable()->comment('クーポンURL');
            $table->string('coupon_url_mobile')->nullable()->comment('モバイル版クーポンURL');
            $table->string('shop_image1')->nullable()->comment('店舗イメージ1');
            $table->string('shop_image2')->nullable()->comment('店舗イメージ2');
            $table->string('qrcode')->nullable()->comment('QLコード');
            $table->string('address')->nullable()->comment('住所');
            $table->string('tel')->nullable()->comment('電話番号');
            $table->string('fax')->nullable()->comment('FAX');
            $table->string('opentime')->nullable()->comment('開店時間帯');
            $table->string('holiday')->nullable()->comment('休日');
            $table->string('access')->nullable()->comment('アクセス');
            $table->string('parking_lots')->nullable()->comment('駐車場');
            $table->string('pr_short')->nullable()->comment('紹介文short');
            $table->string('pr_long')->nullable()->comment('紹介文long');
            $table->integer('budget')->nullable()->comment('予算');
            $table->integer('party')->nullable()->comment('夕食');
            $table->integer('lunch')->nullable()->comment('昼食');
            $table->string('credit_card')->nullable()->comment('クレジットカード');
            $table->string('e_money')->nullable()->comment('電子決済');
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
        Schema::dropIfExists('shopinfo');
    }
}
