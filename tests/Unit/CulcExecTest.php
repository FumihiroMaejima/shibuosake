<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CulcExecTest extends CulcExec
{
    /**
     * @var CulcExec
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
        $this->object = new CulcExec();
    }

    /**
     * 文字列結合関数の検証
     */
    public function testCombineStr()
    {
        // 引数に'趣味','釣り'を渡して想定値が返ってくることを確認する
        $this->assertEquals('趣味 : 釣り', $this->object->combineStr('趣味', '釣り'));
    }

    /**
     * 0~99チェック関数の検証
     */
    public function testCheckBetween0To100()
    {
        // 引数に30を渡すとTRUEが返ってくることを確認する
        $this->assertTrue($this->object->checkBetween0To100(30));

        // 引数に100を渡すとFALSEが返ってくることを確認する
        $this->assertFalse($this->object->checkBetween0To100(100));
    }

    /**
     * 変数型チェックの検証
     */
    public function testCommentToBeer()
    {
        // 引数に'麦酒'の入った文字列を渡すと文字列型が返ってくることを確認する
        // http://apigen.juzna.cz/doc/sebastianbergmann/phpunit/class-PHPUnit_Framework_Constraint_IsType.html
        $this->assertInternalType('string', $this->object->commentToBeer('麦酒おくれ'));

        // 引数に'麦酒'の入っていない文字列を渡すとNULLが返ってくることを確認する
        $this->assertNull($this->object->commentToBeer('水でいいや'));
    }
}
