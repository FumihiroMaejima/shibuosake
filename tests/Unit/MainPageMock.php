<?php

namespace Tests\Unit;

use Tests\Unit\MainPageCommon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainPageMock extends MainPageCommon
{
    /**
     * @var MainPageCommon
     */
    protected $commonObj;

    /**
     * setUpは各テストメソッドが実行される前に実行する
     * 親クラスのsetUpを必ず実行する
     */
    protected function setUp(): void
    {
        parent::setUp();

        // テストするオブジェクトを生成する
        $this->commonObj = new MainPageCommon();

        $testData = array(
            'total_hit_count' => 181,
            'hit_per_page' => 10,
            'page_offset' => 1,
            'rest' => array(
                0 => array(
                    'id' => 'test1120',
                    'update_date' => '2016-6-2',
                    'name' => 'テスト渋谷居酒屋',
                    'category' => '渋谷カフェ＆ダイニング',
                    'url' => 'http://localhost',
                    'url_mobile' => 'http://localhost',
                    'coupon_url' => array(
                        'pc' => 'http://localhost',
                    ),
                    'image_url' => array(
                        'shop_image1' => 'http://localhost',
                        'shop_image2' => 'http://localhost',
                    ),
                    'address' => '〒150-0044 東京都渋谷区テスト町1-2-3 テストビル',
                    'tel' => '123-1234-1234',
                    'opentime' => '月～金 ランチ：12:00～15:00(L.O.14:30)、ディナー：18:00～24:00(L.O.23:00、ドリンクL.O.23:30) \n土・日・祝 ディナー：18:00～24:00(L.O.23:00、ドリンクL.O.23:30)',
                    'holiday' => '不定休日あり',
                    'access' => array(
                        'line' => 'JR',
                        'station' => '渋谷駅',
                        'station_exit' => 'ハチ公口',
                        'walk' => '10',
                    ),
                    'pr' => array(
                        'pr_short' => 'テスト渋谷居酒屋のショート版PR',
                        'pr_long' => 'テスト渋谷居酒屋のロング版PR',
                    ),
                    'code' => array(
                        'areacode' => 'AREA110',
                        'areaname' => '関東',
                        'prefcode' => 'PREF13',
                        'prefname' => '東京都',
                        'areacode_s' => 'AREAS2126',
                        'areaname_s' => '道玄坂・神泉',
                        'category_code_l' => array(
                            0 => 'RSFST10000',
                            1 => 'RSFST21000',
                        ),
                        'category_name_l' => array(
                            0 => 'ダイニングバー・バー・ビアホール',
                            1 => 'お酒',
                        ),
                        'category_code_s' => array(
                            0 => 'RSFST10005',
                            1 => 'RSFST21008',
                        ),
                        'category_name_s' => array(
                            0 => 'バー',
                            1 => 'カクテル',
                        ),
                    ),
                    'budget' => 3000,
                    'party' => 3000,
                    'lunch' => 950,
                    'credit_card' => 'VISA,MasterCard',
                ),
            ),
        );

        //$this->commonObj->setData($testData);
        //print var_dump($this->commonObj->data);
        $this->commonObj->data = $testData;
    }

    /**
     * データ分類のテスト
     */
    public function classificationData($searchKey, $commonObj)
    {
        //print var_dump($commonObj);
        //print var_dump($commonObj->data);
        $test = isset($commonObj->data);
        if (!$test) {
            return false;
        }
        $checkData = $commonObj->data;

        $searchData = null;

        /* 整形用のデータを作成 */
        /*
        // 該当件数
        $totalHitCount = null;
        // 表示件数
        $hitPerPage = null;
        // 表示ページ
        $pageOffset = null;
        // 飲食店情報配列
        $restaurantArray = null;
        // 画面出力用データ
        $viewData = null;
        // ページ数
        $pageCount = 1;
        */

        // 配列のkeyによってデータを振り分ける
        foreach ($checkData as $responseKey => $apiData) {
            switch ($responseKey) {
                case $searchKey:
                    $searchData = $apiData;
                    break;
                /*
                case 'total_hit_count':
                    $totalHitCount = $apiData;
                    break;
                case 'hit_per_page':
                    $hitPerPage = $apiData;
                    break;
                case 'page_offset':
                    $pageOffset = $apiData;
                    break;
                case 'rest':
                    $restaurantArray = $apiData;
                    $viewData = json_encode($restaurantArray);
                    break;
                */
                default:
                    break;
            }
        }

        $existKey = array_key_exists($searchKey, $checkData);
        if ($existKey === false) {
            return false;
        }

        print $commonObj->getDate() . "$searchKey is $searchData" . "\n";
        return $existKey;
    }

    /**
     * 足し算かつ1,000プラスして返却
     */
    /*
    public function addThousand($value1, $value2, $commonObj)
    {
        $chkInt = $commonObj->checkInteger($value1, $value2);
        if ($chkInt === false) {
            return null;
        }

        $ret = $value1 + $value2 + $commonObj->getThousand();
        print $commonObj->getDate() . "Calculate $value1 + $value2 + " . $commonObj->getThousand() . " = " . $ret . "\n";

        return ($ret);
    }
    */

}
