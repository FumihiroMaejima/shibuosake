<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\Area;
use App\Model\Category;
use App\Model\ShopInfo;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainPageCommon extends TestCase
{
    protected $data;

    /**
     * 数値チェック
     */
    public function checkInteger($value1, $value2)
    {
        if (is_int($value1) && is_int($value2)) {
            return true;
        } else {
            print "Invalid first[" . $value1 . "] second[" . $value2 . "]\n";
            return false;
        }
    }

    /**
     * 合計検索数チェック
     */
    public function checkTotalHitCount($totalHitCount, $hitPerPage)
    {
        // 1回の実行で取得出来る数よりも合計のデータ数が多い場合
        if ($totalHitCount > $hitPerPage) {
            return true;
        } else {
            return false;
        }
    }

    public function getShopInfoData()
    {
        //$queryData = $this->ShopInfo->all();
        //$shopinfotest = new \App\Model\ShopInfo();
        $shopinfotest = new \App\Model\ShopInfo();
        $queryData = $shopinfotest->select('info_id')->latest()->first();
        //echo var_dump($queryData);
        //$queryData = DB::table('shopinfo')->select('info_id')->latest()->first();


        // データを取得出来た場合
        if ($queryData) {
            return $queryData->info_id;
        } else {
            return false;
        }
    }

    /**
     * 1000を返す
     */
    public function getThousand()
    {
        return 1000;
    }

    /**
     * 現在時刻を文字列形式で返す
     */
    public function getDate()
    {
        return date("Y/m/d H:i:s") . " : ";
    }
}
