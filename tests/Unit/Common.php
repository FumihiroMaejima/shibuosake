<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Common extends TestCase
{
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
