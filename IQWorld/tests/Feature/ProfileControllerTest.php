<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile()
    {
        $user = User::factory()->create();

        $response = $this->get('/profile/' . $user->id);
        $response->assertStatus(200);
        $response->assertViewIs('pages.profile');
        $response->assertViewHas('user', $user);
    }

}