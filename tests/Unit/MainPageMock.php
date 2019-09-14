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
    protected $CommonObj;

    /**
     * setUpは各テストメソッドが実行される前に実行する
     * 親クラスのsetUpを必ず実行する
     */
    protected function setUp(): void
    {
        parent::setUp();

        // テストするオブジェクトを生成する
        $this->commonObj = new MainPageCommon();
    }

    /**
     * 足し算かつ1,000プラスして返却
     */
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
}
