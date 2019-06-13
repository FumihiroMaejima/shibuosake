<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintenancePageController extends Controller
{
    public function index()
    {
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

        /* 整形用のデータを作成 */
        // 該当件数
        $totalHitCount = null;
        // 表示件数
        $hitPerPage = null;
        // 表示ページ
        $pageOffset = null;
        $restArray = null;

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
        //dd($test);
        //echo var_dump($totalHitCount);
        //echo var_dump($viewData);
        //dd($viewData);

        return view('maintenance.index')->with('viewData', $viewData);
    }
}
