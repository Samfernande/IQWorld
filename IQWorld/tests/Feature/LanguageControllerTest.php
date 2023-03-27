<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    public function test_switch_lang()
    {
        $response = $this->get('/language/fr');
        $response->assertStatus(302);
        $this->assertEquals('fr', session('locale'));

        $response = $this->get('/language/en');
        $response->assertStatus(302);
        $this->assertEquals('en', session('locale'));
    }
}