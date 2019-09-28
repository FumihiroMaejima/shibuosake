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
        // MainPageMockクラスのsetUp()処理を行う
        // $this->commonObjが利用可能になる
        parent::setUp();

        // テストするオブジェクトを生成する
        // このインスタンスではsetUp()処理が行われない
        $this->object = new MainPageMock();
    }

    /**
     * APIデータの分類処理テスト　key
     */
    public function testClassificationDataOfKey()
    {
        $testTarget = 'key';
        $mockObj = $this->getMockBuilder('MainPageCommon')->setMethods(array(/*'checkInteger', */'getThousand', 'getDate'))->getMock();
        //$mockObj = $this->object;

        //$mockObj = $this->createMock(MainPageCommon::class);

        //print var_dump($this->object);
        //$mockObj->expects($this->once())->method('checkInteger')->willReturn(true);
        //$mockObj->expects($this->once())->method('setData')->willReturn(true);
        //$mockObj->expects($this->exactly(2))->method('getThousand')->willReturn(1000);
        //$mockObj->expects($this->once())->method('getDate')->willReturn(date("Y/m/d H:i:s") . " : ");

        //$result = $this->object->classificationData('total_hit_count', $mockObj);
        $totalHitCountKey = $this->object->classificationData($testTarget, 'total_hit_count', $this->commonObj);
        $hitPerPageKey = $this->object->classificationData($testTarget, 'hit_per_page', $this->commonObj);
        $pageOffsetKey = $this->object->classificationData($testTarget, 'page_offset', $this->commonObj);
        $restKey = $this->object->classificationData($testTarget, 'rest', $this->commonObj);
        $falseKey = $this->object->classificationData($testTarget, 'test', $this->commonObj);
        //$this->assertEquals(1003, $result);
        $this->assertTrue($totalHitCountKey);
        $this->assertTrue($hitPerPageKey);
        $this->assertTrue($pageOffsetKey);
        $this->assertTrue($restKey);
        $this->assertFalse($falseKey);
    }

    /**
     * APIデータの分類処理テスト データ
     */
    public function testClassificationDataOfData()
    {
        $testTarget = 'data';

        $totalHitCountData = $this->object->classificationData($testTarget, 'total_hit_count', $this->commonObj);
        $hitPerPageData = $this->object->classificationData($testTarget, 'hit_per_page', $this->commonObj);
        $pageOffsetData = $this->object->classificationData($testTarget, 'page_offset', $this->commonObj);
        $restData = $this->object->classificationData($testTarget, 'rest', $this->commonObj);
        $falseData = $this->object->classificationData($testTarget, 'test', $this->commonObj);

        $this->assertEquals(181, $totalHitCountData);
        $this->assertEquals(10, $hitPerPageData);
        $this->assertEquals(1, $pageOffsetData);
        $this->assertFalse($restData);
        $this->assertFalse($falseData);
    }

    /**
     * totalHitCount test data
     * param1.total
     * param2.shop count per page
     * param3.pageCount
     */
    public function totalHitCountProvider()
    {
        return array(
            'test1' => array(181, 10, 19),
        );
    }

    /**
     * 店舗情報の件数チェック
     * @dataProvider totalHitCountProvider
     */
    public function testGetShopInfoQueryData($totalCount, $hitCount, $result)
    {
        $mockObj = $this->getMockBuilder('MainPageCommon')->setMethods(array('checkTotalHitCount', 'getDate'))->getMock();

        $mockObj->expects($this->once())->method('checkTotalHitCount')->with($totalCount, $hitCount)->willReturn(true);
        $mockObj->expects($this->once())->method('getDate')->willReturn(date("Y/m/d H:i:s") . " : ");

        // mockオブジェクトをパラメーターに渡し、mockオブジェクトで設定したメソッドを必ず利用すること
        $execCount = $this->object->getPageCount($totalCount, $hitCount, $mockObj);
        $this->assertEquals($result, $execCount);
    }

    /**
     * DBから店舗情報取得処理テスト
     */
    public function testGetPageCount()
    {
        $lastedShopInfoId = $this->object->getShopInfoQueryData($this->commonObj);
        $this->assertTrue($lastedShopInfoId);
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
