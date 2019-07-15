<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicCulc extends TestCase
{
    /**
     * 足し算
     */
    public function add($key, $value)
    {
        return ($key + $value);
    }

    /**
     * 引き算
     */
    public function subtract($key, $value)
    {
        return ($key - $value);
    }

    /**
     * 掛け算
     */
    public function multiply($key, $value)
    {
        return ($key * $value);
    }

    /**
     * 割り算
     */
    public function divide($key, $value)
    {
        return ($key / $value);
    }
}
