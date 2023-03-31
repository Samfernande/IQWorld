<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    public function testRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'TestUser')
                    ->type('email', 'test@examplee.com')
                    ->type('password', 'password1234')
                    ->type('password_confirmation', 'password1234')
                    ->press("#registerButton")
                    ->assertPathIs('/');
        });
    }
}
