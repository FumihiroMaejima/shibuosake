<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    // aboutページの表示
    public function index()
    {
        // 問い合わせ先
        $access = env('INCUIRY_TO');
        return view('about.index')->with('access', $access);
    }
}
