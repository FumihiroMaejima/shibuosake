<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \GuzzleHttp\Psr7;

class MaintenancePageController extends Controller
{
    public function index()
    {
        //guzzle test
        /**
         * guzzleHttpClientによるAPI実行
         * /RestSearchAPI/:レストラン検索API
         * keyid:アクセスキー
         * address:地名
         * category_l:業態
         **/
        $baseUrl = 'https://api.gnavi.co.jp';
        $path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&address=渋谷&category_l=RSFST21000';
        $client = new \GuzzleHttp\Client([
            'base_uri' => $baseUrl,
        ]);

        //dd($path);

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

        // 表示内容が変わらない
        //$test = mb_convert_encoding($responseBody, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

        $responseData = json_decode($responseBody, true);


        // チェック用
        //dd($responseData);


        /*
        // 画面表示用データ(テスト用)の取得
        //$url = public_path() . '/data/testdata.xml';
        $url = public_path() . '/data/testdata.json';
        // ファイルの中身の取得
        $json = file_get_contents($url);
        // 文字化け防止処理
        $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        // json文字列をPHP変数に変換
        $decodeData = json_decode($json, true);
        //echo var_dump($decodeData);
        */

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

        // チェック用
        //dd($restaurantArray);
        //dd($viewData);

        /*
        // 配列のkeyによってデータを振り分ける
        foreach ($decodeData as $key => $restdata) {
            switch ($key) {
                case 'total_hit_count':
                    $totalHitCount = $restdata;
                    break;
                case 'hit_per_page':
                    $hitPerPage = $restdata;
                    break;
                case 'page_offset':
                    $pageOffset = $restdata;
                    break;
                case 'rest':
                    $restArray[] = $restdata;
                    break;
                default:
                    break;
            }
        }

        $viewData = null;
        //$test = null;
        //dd($restArray);
        // 飲食店データをさらに個々の店舗のデータとしてまとめる
        foreach ($restArray as $attributesData) {
            $viewData = $attributesData;
            $viewData = json_encode($viewData);
        }
        */
        //dd($test);
        //echo var_dump($totalHitCount);
        //echo var_dump($viewData);
        //dd($viewData);

        return view('maintenance.index')->with('viewData', $viewData);
    }
}
