<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index(/*Request $request*/)
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
        $newArray = null;

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
                    $newArray[] = $restdata;
                    break;
                default:
                    break;
            }
        }
        echo var_dump($totalHitCount);

        return view('master');
    }
}
