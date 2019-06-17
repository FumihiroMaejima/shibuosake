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

    public function apitest()
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

        $responseData = json_decode($responseBody, true);

        dd($responseBody);

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

        return view('maintenance.index')->with('viewData', $viewData);
    }
}
