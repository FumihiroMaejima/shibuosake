<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \GuzzleHttp\Psr7;

class MaintenancePageController extends Controller
{
    // トップページの表示
    public function index()
    {
        // レストランデータの取得
        $responseData = self::getRestaurantData();

        /* 整形用のデータを作成 */
        // 該当件数
        $totalHitCount = null;
        // 表示件数
        $hitPerPage = null;
        // 表示ページ
        $pageOffset = null;
        //$restArray = null;
        $restaurantArray = null;
        $viewData = null;

        // 配列のkeyによってデータを振り分ける
        foreach ($responseData as $responseKey => $apiData) {
            switch ($responseKey) {
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
                default:
                    break;
            }
        }

        return view('maintenance.index')->with('viewData', $viewData);
    }

    // レストラン検索APIの実行
    public function getRestaurantData()
    {
        /**
         * guzzleHttpClientによるAPI実行
         * /RestSearchAPI/:レストラン検索API
         * keyid:アクセスキー
         * address:地名
         * areacode_m:エリアコード
         * category_l:大業態/RSFST21000=お酒
         **/
        $baseUrl = 'https://api.gnavi.co.jp';
        //$path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&address=渋谷&category_l=RSFST21000';
        //$path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&areacode_m=AREAM2126&category_l=RSFST21000';
        $path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&areacode_m=AREAM2126&category_l=RSFST21000';
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
            'headers'         => $headers,
        ]);
        $responseBody = (string)$response->getBody();

        $responseData = json_decode($responseBody, true);

        return $responseData;
    }

    public function apitest()
    {
        // APIの実行
        //$responseData = self::execApi();
        $responseData = self::getApiData(0);

        /* 整形用のデータを作成 */
        // 該当件数
        $totalHitCount = null;
        // 表示件数
        $hitPerPage = null;
        // 表示ページ
        $pageOffset = null;
        //$restArray = null;
        $restaurantArray = null;
        $viewData = null;

        // 配列のkeyによってデータを振り分ける
        foreach ($responseData as $responseKey => $apiData) {
            switch ($responseKey) {
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
                default:
                    break;
            }
        }
        //dd($restaurantArray);

        // 1回の実行で取得出来る数よりも合計のデータ数が多い場合
        if ($totalHitCount > $hitPerPage) {
            $restaurantArray = self::getModData($totalHitCount, $hitPerPage, $restaurantArray);
            dd($restaurantArray);
        }


        //$path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&areacode_m=AREAM2126&category_l=RSFST21000' . '&';
        //dd($totalHitCount);

        // チェック用
        //dd($restaurantArray);
        //dd($viewData);

        return view('maintenance.apitest')->with('viewData', $viewData);
    }

    // レストラン検索等のAPIの実行
    public function getApiData($offsetNum)
    {
        $baseUrl = 'https://api.gnavi.co.jp';
        /**
         * 飲食店検索
         * guzzleHttpClientによるAPI実行
         * /RestSearchAPI/:レストラン検索API
         * keyid:アクセスキー
         * address:地名
         * areacode_m:エリアコード
         * category_l:大業態/RSFST21000=お酒
         * category_s:小業態
         **/
        if ($offsetNum == 0) {
            $path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&areacode_m=AREAM2126&category_l=RSFST21000&hit_per_page=100';
        } else {
            $path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&areacode_m=AREAM2126&category_l=RSFST21000&hit_per_page=100&offset_page='. $offsetNum;
        }


        //dd($path);

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
            'headers'         => $headers,
        ]);
        $responseBody = (string)$response->getBody();

        $responseData = json_decode($responseBody, true);

        //dd($responseBody);
        return $responseData;
    }

    // APIの再実行&残りのデータの取得
    public function getModData($totalCount, $hitCount, $restaturantData)
    {
        $execCount = 0;
        $getDataCount = null;
        // 全てのデータを取得出来るまでのAPIの実行回数を求める
        do {
            $execCount++;
            $getDataCount = $hitCount * $execCount;
        } while ($totalCount > $getDataCount);

        // 条件に合う全てのデータを取得するまでAPIを実行する
        for ($i = 2; $i <= $execCount; $i++) {
            //$retryGetData = self::getApiData($i);
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

    // レストラン検索等のAPIの実行
    public function execApi()
    {
        $baseUrl = 'https://api.gnavi.co.jp';
        /**
         * 飲食店検索
         * guzzleHttpClientによるAPI実行
         * /RestSearchAPI/:レストラン検索API
         * keyid:アクセスキー
         * address:地名
         * areacode_m:エリアコード
         * category_l:大業態/RSFST21000=お酒
         * category_s:小業態
         **/
        //$path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&address=渋谷&category_l=RSFST21000';
        //$path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&areacode_m=AREAM2126&category_s=RSFST21001,RSFST21002,RSFST21004';
        //$path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&areacode_m=AREAM2126&category_l=RSFST21000,RSFST09000';
        $path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&areacode_m=AREAM2126&category_l=RSFST21000';

        /**
         * 口コミ検索
         * keyid:アクセスキー
         * area:地名
         * hit_per_page:API1回あたりの検索数(最大50)
         * vote_date:現在日時型何日前までの範囲を指定
         * photo_genre_id:写真ジャンルで絞込み/1:料理・ドリンク,2:店内・外観,3:人物・その他
         * comment:コメント
         * menu_name:メニュー名
         **/
        //$path = '/PhotoSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&area=渋谷&hit_per_page=50&vote_date=720&photo_genre_id=1';

        /**
         * エリア取得
         * エリアLマスタ:GAreaLargeSearchAPI
         * エリアMマスタ:GAreaMiddleSearchAPI
         * エリアSマスタ:GAreaSmallSearchAPI
         * keyid:アクセスキー
         **/
        //$path = '/master/GAreaMiddleSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY');

        /**
         * 業態マスタ取得
         * 大業態マスタ:CategoryLargeSearchAPI
         * 小業態マスタ:CategorySmallSearchAPI
         * keyid:アクセスキー
         **/
        //$path = '/master/CategorySmallSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY');

        //dd($path);

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
            'headers'         => $headers,
        ]);
        $responseBody = (string)$response->getBody();

        $responseData = json_decode($responseBody, true);

        dd($responseBody);
        return $responseData;
    }
}
