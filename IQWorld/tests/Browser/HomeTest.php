<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

//resr
class HomeTest extends DuskTestCase
{
    public function testClickFirstGame()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->click('.card a')
                    ->assertPathIsNot('/');
        });
    }

    public function testAccessToLogin()
    {
        $this->browse(function (Browser $browser)
        {
            $browser->visit('/')
                    ->clickLink(__('text.login'))
                    ->assertPathIs('/login');
        });
    }

    public function testAccessToRegister()
    {
        $this->browse(function (Browser $browser)
        {
            $browser->visit('/')
                    ->clickLink(__('text.register'))
                    ->assertPathIs('/register');
        });
    }
}
