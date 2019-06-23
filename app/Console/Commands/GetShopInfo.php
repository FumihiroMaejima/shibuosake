<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GetShopInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:shopinfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get shop information from API.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // レストラン検索APIの実行
        $responseData = self::getApiData(0);

        // API実行エラーの場合
        if ($responseData == "Client error") {
            die;
        }

        /* 整形用のデータを作成 */
        // 該当件数
        $totalHitCount = null;
        // 表示件数
        $hitPerPage = null;
        // 飲食店情報配列
        $restaurantArray = null;

        // 配列のkeyによってデータを振り分ける
        foreach ($responseData as $responseKey => $apiData) {
            switch ($responseKey) {
                case 'total_hit_count':
                    $totalHitCount = $apiData;
                    break;
                case 'hit_per_page':
                    $hitPerPage = $apiData;
                    break;
                case 'rest':
                    $restaurantArray = $apiData;
                    break;
                default:
                    break;
            }
        }

        // 1回の実行で取得出来る数よりも合計のデータ数が多い場合
        if ($totalHitCount > $hitPerPage) {
            $restaurantArray = self::getModData($totalHitCount, $hitPerPage, $restaurantArray);
        }

        // 店舗情報をDBへ登録
        self::registShopInfo($restaurantArray);
    }

    // レストラン検索等のAPIの実行
    public function getApiData($offsetNum)
    {
        $baseUrl = 'https://api.gnavi.co.jp';

        /**
         * 飲食店検索
         * /RestSearchAPI/:レストラン検索API
         * keyid:アクセスキー
         * areacode_m:エリアコード
         * category_l:大業態/RSFST21000=お酒
         **/
        if ($offsetNum == 0) {
            $path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&areacode_m=AREAM2126&category_l=RSFST21000&hit_per_page=100';
        } else {
            $path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&areacode_m=AREAM2126&category_l=RSFST21000&hit_per_page=100&offset_page=' . $offsetNum;
        }

        $client = new \GuzzleHttp\Client([
            'base_uri' => $baseUrl,
        ]);

        $headers = [
            'Origin'                    => 'https://google.com',
            'Accept-Encoding'           => 'gzip, deflate, br',
            'Accept-Language'           => 'ja,en-US;q=0.8,en;q=0.6',
            'Upgrade-Insecure-Requests' => '1',
            'Content-Type'              => 'application/json; charset=utf-8',
        ];

        $response = $client->request('GET', $path, [
            'allow_redirects' => false,
            'http_errors'     => false,
            'headers'         => $headers,
        ]);
        $responseBody = (string)$response->getBody();

        $responseData = json_decode($responseBody, true);

        // クライアントエラーチェック
        $isClientError = array_key_exists('error', $responseData);
        if ($isClientError) {
            $responseData = "Client error";
        }
        return $responseData;
    }

    // APIの再実行&残りのデータの取得
    public function getModData($totalCount, $hitCount, $restaturantData)
    {
        // 実行回数
        $execCount = 0;
        // 実行回数に対するデータの最大取得数
        $maxDataCount = null;
        // 全てのデータを取得出来るまでのAPIの実行回数を求める
        do {
            $execCount++;
            $maxDataCount = $hitCount * $execCount;
        } while ($totalCount > $maxDataCount);

        // 条件に合う全てのデータを取得するまでAPIを実行する
        for ($i = 2; $i <= $execCount; $i++) {
            $tmpGetData = self::getApiData($i);
            // 再実行して取得したデータを元の配列に追加する
            foreach ($tmpGetData as $tmpKey => $tmpApiData) {
                if ($tmpKey == 'rest') {
                    foreach ($tmpApiData as $restData) {
                        $restaturantData[] = $restData;
                    }
                }
            }
        }
        return $restaturantData;
    }

    // 各店舗情報をDBに登録
    public function registShopInfo($getData)
    {
        try {
            // 現在のidの最大値を取得
            $newInfoId = self::updateInfoId();

            // 1店舗ごとにテーブルに登録する
            foreach ($getData as $restInfo) {
                // shopInfoオブジェクトを作成
                $shopInfo = new \App\Model\ShopInfo;

                // 値の登録
                $shopInfo->info_id = $newInfoId;
                $shopInfo->shop_id = $restInfo['id'];
                $shopInfo->shop_update_date = $restInfo['update_date'];
                $shopInfo->name = $restInfo['name'];
                $shopInfo->latitude = $restInfo['latitude'];
                $shopInfo->longitude = $restInfo['longitude'];
                $shopInfo->category = $restInfo['category'];
                $shopInfo->url = $restInfo['url'];
                $shopInfo->url_mobile = $restInfo['url_mobile'];
                $shopInfo->coupon_url_pc = $restInfo['coupon_url']['pc'];
                $shopInfo->coupon_url_mobile = $restInfo['coupon_url']['mobile'];
                $shopInfo->shop_image1 = $restInfo['image_url']['shop_image1'];
                $shopInfo->shop_image2 = $restInfo['image_url']['shop_image2'];
                $shopInfo->qrcode = $restInfo['image_url']['qrcode'];
                $shopInfo->address = $restInfo['address'];
                $shopInfo->tel = $restInfo['tel'];
                $shopInfo->fax = $restInfo['fax'];
                $shopInfo->opentime = $restInfo['opentime'];
                $shopInfo->holiday = $restInfo['holiday'];
                $shopInfo->access = $restInfo['access']['line'] . $restInfo['access']['line'] . $restInfo['access']['station'] . $restInfo['access']['station_exit'] . $restInfo['access']['walk'];
                $shopInfo->parking_lots = $restInfo['parking_lots'];
                $shopInfo->pr_short = $restInfo['pr']['pr_short'];
                $shopInfo->pr_long = $restInfo['pr']['pr_long'];
                $shopInfo->budget = $restInfo['budget'];
                $shopInfo->party = $restInfo['party'];
                $shopInfo->lunch = $restInfo['lunch'];
                $shopInfo->credit_card = $restInfo['credit_card'];
                $shopInfo->e_money = $restInfo['e_money'];

                // 保存(DBに登録完了)
                $shopInfo->save();
            }
        } catch (Exception $e) {
            $e->getMessage();
            return redirect()->to('errors/500');
        }
    }

    // 情報IDの更新と取得処理
    public function updateInfoId()
    {
        // 情報IDの最新値を取得して1つ更新した値を返す。
        $queryData = DB::table('shopinfo')->select('info_id')->latest()->first();
        $infoId = null;

        if (isset($queryData)) {
            $tmpId = $queryData->info_id;
            $infoId = ++$tmpId;
        } else {
            $infoId = 1;
        }
        return $infoId;
    }
}
