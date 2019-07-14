<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteShopInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:shopinfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete oldest shop information.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            // 最小の情報IDを取得
            $queryDataOld = DB::table('shopinfo')->select('info_id')->oldest()->first();
            // 最大の情報IDを取得
            $queryDataLatest = DB::table('shopinfo')->select('info_id')->latest()->first();

            // 情報IDが１つしか無い場合は削除処理は行わない
            if ($queryDataOld->info_id == $queryDataLatest->info_id) {
                die;
            }

            $targetInfoId = $queryDataOld->info_id;
            // 対象の情報IDを削除する
            \App\Model\ShopInfo::where('info_id', '=', $targetInfoId)->delete();
        } catch (Exception $e) {
            $e->getMessage();
            die;
        }
    }
}
