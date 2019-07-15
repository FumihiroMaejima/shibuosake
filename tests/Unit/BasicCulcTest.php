<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicCulcTest extends TestCase
{
    /**
     * @var BasicCulc
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
        $this->object = new BasicCulc();
    }

    /**
     * 足し算関数の検証
     */
    public function testAdd()
    {
        // 引数に3,5を渡すと8が返ってくることを確認する
        $this->assertEquals(8, $this->object->add(3, 5));
    }

    /**
     * 引き算関数の検証
     */
    public function testSubtract()
    {
        // 引数に10,3を渡すと7が返ってくることを確認する
        $this->assertEquals(7, $this->object->subtract(10, 3));
    }

    /**
     * 掛け算関数の検証
     */
    public function testMultiply()
    {
        // 引数に4,6を渡すと24が返ってくることを確認する
        $this->assertEquals(24, $this->object->multiply(4, 6));
    }

    /**
     * 割り算関数の検証
     */
    public function testDivide()
    {
        // 引数に6,2を渡すと3が返ってくることを確認する
        $this->assertEquals(3, $this->object->divide(6, 2));
    }
}
