<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MockBasicCulcTest extends MockBasicCulc
{
    /**
     * @var MockBasicCulc
     */
    protected $object;

    /**
     * setUpは各テストメソッドが実行される前に実行する
     * 親クラスのsetUpを必ず実行する
     */
    protected function setUp(): void
    {
        parent::setUp();

        // テストするオブジェクトを生成する
        $this->object = new MockBasicCulc();
    }

    /**
     * モックオブジェクトの説明(Common.phpのモックを作ってみる)
     */
    public function testTutorial()
    {
        $mockObj = $this->getMockBuilder('Common')->setMethods(array('checkInteger'))->getMock();

        $mockObj->expects($this->once())->method('checkInteger')->with(1, 2)->willReturn(true);

        $result = $mockObj->checkInteger(1, 2);
        $this->assertTrue($result);
    }

    /**
     * addThousandの検証
     */
    public function testAddThousand()
    {
        $mockObj = $this->getMockBuilder('Common')->setMethods(array('checkInteger', 'getThousand', 'getDate'))->getMock();

        $mockObj->expects($this->once())->method('checkInteger')->willReturn(true);
        $mockObj->expects($this->exactly(2))->method('getThousand')->willReturn(1000);
        $mockObj->expects($this->once())->method('getDate')->willReturn(date("Y/m/d H:i:s") . " : ");

        $result = $this->object->addThousand(1, 2, $mockObj);
        $this->assertEquals(1003, $result);
    }
}
