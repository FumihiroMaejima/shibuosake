<?php

namespace App\Http\Middleware;

use Closure;

class IpLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // IPの配列
        $whiteListIp = [
            ['id' => 1, 'name' => 'admin', 'ip' => env(' ADMIN_CONTROL_IP ')]
        ];

        /* 変数$ipにアクセスされたIPが含まれているかチェック */
        // $request->ip() で クライアント ipが取得できる
        $detect = collect($whiteListIp)->contains('ip', $request->ip());

        // ipが含まれていない時の処理
        if (!$detect) {
            // ここでは route()->name('invalid')にリダイレクト
            // return redirect('invalid');
            return redirect()->to('errors/404');
        }
        // ipが含まれていればリクエストが通る
        return $next($request);
    }
}
