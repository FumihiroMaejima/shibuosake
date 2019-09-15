<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainPageMockTest extends MainPageMock
{
    /**
     * @var MainPageMock
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
        $this->object = new MainPageMock();
        //print var_dump($this->commonObj);
    }

    /**
     * モックオブジェクトの説明(MainPageCommon.phpのモックを作ってみる)
     */
    public function testClassificationData()
    {
        $mockObj = $this->getMockBuilder('MainPageCommon')->setMethods(array(/*'checkInteger', */'getThousand', 'getDate'))->getMock();
        //$mockObj = $this->object;

        //$mockObj = $this->createMock(MainPageCommon::class);

        //print var_dump($this->object);
        //$mockObj->expects($this->once())->method('checkInteger')->willReturn(true);
        //$mockObj->expects($this->once())->method('setData')->willReturn(true);
        //$mockObj->expects($this->exactly(2))->method('getThousand')->willReturn(1000);
        //$mockObj->expects($this->once())->method('getDate')->willReturn(date("Y/m/d H:i:s") . " : ");

        //$result = $this->object->classificationData('total_hit_count', $mockObj);
        $result = $this->object->classificationData('total_hit_count', $this->commonObj);
        $result2 = $this->object->classificationData('hit_per_page', $this->commonObj);
        $result3 = $this->object->classificationData('page_offset', $this->commonObj);
        $result4 = $this->object->classificationData('rest', $this->commonObj);
        $result5 = $this->object->classificationData('test', $this->commonObj);
        //$this->assertEquals(1003, $result);
        $this->assertTrue($result);
        $this->assertTrue($result2);
        $this->assertTrue($result3);
        $this->assertTrue($result4);
        $this->assertFalse($result5);
    }


    /**
     * モックオブジェクトの説明(Common.phpのモックを作ってみる)
     */
    /*
    public function testTutorial()
    {
        $mockObj = $this->getMockBuilder('Common')->setMethods(array('checkInteger'))->getMock();

        $mockObj->expects($this->once())->method('checkInteger')->with(1, 2)->willReturn(true);

        $result = $mockObj->checkInteger(1, 2);
        $this->assertTrue($result);
    }
    */

    /**
     * addThousandの検証
     */
    /*
    public function testAddThousand()
    {
        $mockObj = $this->getMockBuilder('Common')->setMethods(array('checkInteger', 'getThousand', 'getDate'))->getMock();

        $mockObj->expects($this->once())->method('checkInteger')->willReturn(true);
        $mockObj->expects($this->exactly(2))->method('getThousand')->willReturn(1000);
        $mockObj->expects($this->once())->method('getDate')->willReturn(date("Y/m/d H:i:s") . " : ");

        $result = $this->object->addThousand(1, 2, $mockObj);
        $this->assertEquals(1003, $result);
    }
    */
}
