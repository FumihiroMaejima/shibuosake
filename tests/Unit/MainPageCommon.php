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

    public function getShopInfoCount()
    {
        $shopinfoObj = new \App\Model\ShopInfo();
        $queryData = $shopinfoObj->select('info_id')->latest()->first();

        // データを取得出来た場合
        if ($queryData) {
            return $queryData->info_id;
        } else {
            return false;
        }
    }

    public function getShopInfoData($targetId)
    {
        $shopinfoObj = new \App\Model\ShopInfo();
        $queryData = $shopinfoObj->selectRaw('
                        info_id,
                        shop_id,
                        name,
                        url,
                        shop_image1,
                        category,
                        areacode_s,
                        areaname_s,
                        category_code_l,
                        category_name_l,
                        category_code_s,
                        category_name_s
                    ')
                    ->whereRaw('info_id = ?', $targetId)
                    ->get();

        // データを取得出来た場合
        if ($queryData) {
            return $queryData;
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
