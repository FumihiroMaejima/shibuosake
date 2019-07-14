<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \GuzzleHttp\Psr7;
use Illuminate\Support\Facades\DB;

class MainPageController extends Controller
{
    // トップページの表示
    public function index()
    {
        // レストランデータの取得
        $responseData = self::getRestaurantData(1);

        // API実行エラーの場合
        if ($responseData == "Client error") {
            return redirect()->to('errors/404');
        }

        /* 整形用のデータを作成 */
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

        // 1回の実行で取得出来る数よりも合計のデータ数が多い場合
        if ($totalHitCount > $hitPerPage) {
            $pageCount = self::getPageCount($totalHitCount, $hitPerPage);
        }

        /** エリア情報ごとカテゴリーごとの情報を取得 **/
        // 店舗情報の取得
        $shopData = self::getShopInfoQueryData();
        // エリア情報とカテゴリー情報の取得
        $areaData = self::getAreaData();
        $categoryData = self::getCategoryData();

        // 店舗情報とエリア情報の照会
        $tmpAreaViewData = self::makeAreaViewData($shopData, $areaData);
        $areaCount = json_encode(self::getCountData($tmpAreaViewData), true);
        $areaViewData = json_encode($tmpAreaViewData, true);

        // 店舗情報とカテゴリー情報の照会
        $tmpCategoryViewData = self::makeCategoryViewData($shopData, $categoryData);
        $categoryCount = json_encode(self::getCountData($tmpCategoryViewData));
        $categoryViewData = json_encode($tmpCategoryViewData);
        // Vueファイルのテンプレート切替用の変数
        $tabCheckData = array('shop' => 1, 'area' => 2, 'category' => 3);

        return view('main.index')
            ->with('viewData', $viewData)
            ->with('pageOffset', $pageOffset)
            ->with('pageCount', $pageCount)
            ->with('areaViewData', $areaViewData)
            ->with('categoryViewData', $categoryViewData)
            ->with('areaCount', $areaCount)
            ->with('categoryCount', $categoryCount)
            ->with('tabCheckData', $tabCheckData);
    }

    // ページリクエスト処理
    public function pageIndex($count)
    {
        // パラメーターチェック
        self::countCheck($count);

        // レストランデータの取得
        $responseData = self::getRestaurantData($count);

        // API実行エラーの場合
        if ($responseData == "Client error") {
            return view('errors.404');
        }

        /* 整形用のデータを作成 */
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

        // 1回の実行で取得出来る数よりも合計のデータ数が多い場合
        if ($totalHitCount > $hitPerPage) {
            $pageCount = self::getPageCount($totalHitCount, $hitPerPage);
        }

        /** エリア情報ごとカテゴリーごとの情報を取得 **/
        // 店舗情報の取得
        $shopData = self::getShopInfoQueryData();
        // エリア情報とカテゴリー情報の取得
        $areaData = self::getAreaData();
        $categoryData = self::getCategoryData();

        // 店舗情報とエリア情報の照会
        $tmpAreaViewData = self::makeAreaViewData($shopData, $areaData);
        $areaCount = json_encode(self::getCountData($tmpAreaViewData));
        $areaViewData = json_encode($tmpAreaViewData);
        // 店舗情報とカテゴリー情報の照会
        $tmpCategoryViewData = self::makeCategoryViewData($shopData, $categoryData);
        $categoryCount = json_encode(self::getCountData($tmpCategoryViewData));
        $categoryViewData = json_encode($tmpCategoryViewData);
        // Vueファイルのテンプレート切替用の変数
        $tabCheckData = array('shop' => 1, 'area' => 2, 'category' => 3);

        return view('main.index')
            ->with('viewData', $viewData)
            ->with('pageOffset', $pageOffset)
            ->with('pageCount', $pageCount)
            ->with('areaViewData', $areaViewData)
            ->with('categoryViewData', $categoryViewData)
            ->with('areaCount', $areaCount)
            ->with('categoryCount', $categoryCount)
            ->with('tabCheckData', $tabCheckData);
    }

    // レストラン検索APIの実行
    public function getRestaurantData($offsetNum)
    {
        try {
            /**
             * guzzleHttpClientによるAPI実行
             * /RestSearchAPI/:レストラン検索API
             * keyid:アクセスキー
             * address:地名
             * areacode_m:エリアコード
             * category_l:大業態/RSFST21000=お酒
             * hit_per_page:１ページあたりの店舗情報数学
             * offset_page:街灯のページ数
             **/
            $baseUrl = 'https://api.gnavi.co.jp';
            //$path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&address=渋谷&category_l=RSFST21000';
            //$path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&areacode_m=AREAM2126&category_l=RSFST21000';
            //$path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&areacode_m=AREAM2126&category_l=RSFST21000';
            if ($offsetNum == 1) {
                $path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&areacode_m=AREAM2126&category_l=RSFST21000&hit_per_page=10&offset_page=1';
            } else {
                $path = '/RestSearchAPI/v3/?keyid=' . env('GURUNAVI_ACCESS_KEY') . '&areacode_m=AREAM2126&category_l=RSFST21000&hit_per_page=10&offset_page=' . $offsetNum;
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
        } catch (Exception $e) {
            return redirect()->to('errors/500');
        }
    }

    // 店舗情報のページ数の取得
    public function countCheck($num)
    {
        // 数値チェック
        $isDigit = ctype_digit($num);
        // 桁数チェック
        $isRightLength = mb_strlen($num);

        if (($isDigit == false) || ($isRightLength > 2)) {
            return view('errors.404');
        }
    }

    // 店舗情報のページ数の取得
    public function getPageCount($totalCount, $hitCount)
    {
        $execCount = 0;
        $maxDataCount = null;
        // 全てのデータを取得出来るまでのAPIの実行回数を求める
        do {
            $execCount++;
            $maxDataCount = $hitCount * $execCount;
        } while ($totalCount > $maxDataCount);

        return $execCount;
    }

    // DBに登録されている店舗情報の検索
    public function getShopInfoQueryData()
    {
        try {
            // 最新の情報IDを取得する
            $queryData = DB::table('shopinfo')->select('info_id')->latest()->first();

            // 情報IDが取得出来た場合最新の店舗情報を取得
            if (isset($queryData)) {
                $shopInfo = \App\Model\ShopInfo::selectRaw('
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
                    ->whereRaw('info_id = ?', $queryData)
                    ->get();

                $shopData = null;
                // 店舗情報の整形
                foreach ($shopInfo as $shopRow) {
                    $tmpId = $shopRow->shop_id;
                    $tmpShopName = $shopRow->name;
                    $tmpShopURL = $shopRow->url;
                    $tmpShopImage1 = $shopRow->shop_image1;
                    $tmpAreaCode = $shopRow->areacode_s;
                    $thisCategoryCode = explode(',', $shopRow->category_code_s);
                    $thisCategoryName = explode(',', $shopRow->category_name_s);
                    $tmpCategoryName = $thisCategoryName;

                    $shopData[$tmpId]['name'] = $tmpShopName;
                    $shopData[$tmpId]['url'] = $tmpShopURL;
                    $shopData[$tmpId]['shop_image1'] = $tmpShopImage1;
                    $shopData[$tmpId]['area'] = $tmpAreaCode;
                    $shopData[$tmpId]['category_code'] = $thisCategoryCode;
                    $shopData[$tmpId]['category_name'] = $tmpCategoryName;
                }

                return $shopData;
            } else {
                return redirect()->to('errors/404');
            }
        } catch (Exception $e) {
            return redirect()->to('errors/500');
        }
    }

    // エリア情報の取得
    public function getAreaData()
    {
        try {
            // 最新のエリア情報IDを取得する
            $latestAreaInfoId = DB::table('area')->select('area_info_id')->latest()->first();

            // エリアIDが取得出来た場合最新のエリア情報を取得する
            if (isset($latestAreaInfoId)) {
                $areaInfo = \App\Model\Area::where('area_info_id', $latestAreaInfoId->area_info_id)
                    ->orderBy('areacode_s', 'asc')
                    ->get();

                $areaData = null;
                // エリア情報の整形
                foreach ($areaInfo as $areaRow) {
                    $tmpCode = $areaRow->areacode_s;
                    $areaData[$tmpCode] = $areaRow->areaname_s;
                }

                return $areaData;
            } else {
                return redirect()->to('errors/404');
            }
        } catch (Exception $e) {
            return redirect()->to('errors/500');
        }
    }

    //カテゴリー情報の取得
    public function getCategoryData()
    {
        try {
            // 最新のエリア情報IDを取得する
            $latestCategoryInfoId = DB::table('category')->select('category_info_id')->latest()->first();

            // エリアIDが取得出来た場合最新のエリア情報を取得する
            if (isset($latestCategoryInfoId)) {
                $categoryInfo = \App\Model\Category::where('category_info_id', $latestCategoryInfoId->category_info_id)
                    ->orderBy('category_code_s', 'asc')
                    ->get();

                $categoryData = null;
                // カテゴリー情報の整形
                foreach ($categoryInfo as $categoryRow) {
                    $tmpCode = $categoryRow->category_code_s;
                    $categoryData[$tmpCode] = $categoryRow->category_name_s;
                }

                return $categoryData;
            } else {
                return redirect()->to('errors/404');
            }
        } catch (Exception $e) {
            return redirect()->to('errors/500');
        }
    }

    // 店舗情報とエリア情報の照会
    public function makeAreaViewData($shopData, $areaData)
    {
        $areaViewData = null;
        // １店舗ごとに合致するエリアを探索する
        foreach ($shopData as $shopId => $shopInfo) {
            foreach ($areaData as $areaCode => $areaName) {
                if ($shopInfo['area'] === $areaCode) {
                    $areaViewData[$areaName][$shopId] = $shopInfo;
                    break;
                }
            }
        }

        return $areaViewData;
    }

    // 店舗情報とカテゴリー情報の照会
    public function makeCategoryViewData($shopData, $categoryData)
    {
        $categoryViewData = null;
        // １店舗ごとに合致するエリアを探索する
        foreach ($shopData as $shopId => $shopInfo) {
            foreach ($categoryData as $categoryCode => $categoryName) {
                $categoryIsMatch = array_search($categoryCode, $shopInfo['category_code']);
                if ($categoryIsMatch) {
                    $categoryViewData[$categoryName][$shopId] = $shopInfo;
                    break;
                }
            }
        }

        return $categoryViewData;
    }

    // エリア・カテゴリーごとの店舗数をカウントする
    public function getCountData($targetData)
    {
        $returnData = null;
        foreach ($targetData as $targetKey => $shop) {
            $tmpCount = count($shop);
            $returnData[$targetKey] = $tmpCount;
        }
        return $returnData;
    }
}
