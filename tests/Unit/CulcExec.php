<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CulcExec extends TestCase
{
    /**
     * 文字列に特定の文字を結合
     */
    public function combineStr($key, $value)
    {
        return ($key . " : " . $value);
    }

    /**
     * 渡された値が0以上100未満かチェック
     */
    public function checkBetween0To100($key)
    {
        if ($key >= 0 && $key < 100) {
            return true;
        }
        return false;
    }

    /**
     * 渡された値に特定の文字列があれば加工、なければNULLを返却
     */
    public function commentToBeer($key)
    {
        if (strpos($key, '麦酒') !== false) {
            return $key . "←10杯ほしい！\n";
        }
        return null;
    }
}
