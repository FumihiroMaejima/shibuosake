<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainPageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testMainPageView()
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertViewIs('main.index')
            ->assertSee('Shibuya no Osake Site')
            ->assertSee('ぐるなびWebService')
            ->assertSee('new')
            ->assertSee('area')
            ->assertSee('type');
    }

    public function testPagenatedPageView()
    {
        $response = $this->get('/page/1');

        $response->assertStatus(200)
            ->assertViewIs('main.index')
            ->assertSee('Shibuya no Osake Site')
            ->assertSee('ぐるなびWebService')
            ->assertSee('new')
            ->assertSee('area')
            ->assertSee('type');
    }

    public function testPagenatedPage404()
    {
        $response = $this->get('/page/');

        $response->assertStatus(404);
    }

    public function testPagenatedPageStringParam()
    {
        $response = $this->get('/page/test');

        $response->assertStatus(200)->assertViewIs('errors.404');
    }
}
