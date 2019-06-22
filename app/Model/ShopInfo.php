<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopInfo extends Model
{

    //テーブル名指定
    protected $table = 'shopinfo';

    // カラムの自動更新をEloquentに許可
    public $timestamps = true;

    use SoftDeletes;
    // ソフトデリートの有効化(日付へキャストする属性)
    protected $dates = ['deleted_at'];

    // 更新可能なカラムリスト
    protected $fillable = [
        'updated_at'
    ];
}
