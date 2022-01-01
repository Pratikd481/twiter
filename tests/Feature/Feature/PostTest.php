<?php

namespace Tests\Feature\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase, CreatesApplication;

    private function signIn()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        return $this;
    }

    /** @test */
    public function posts_page_can_be_rendered()
    {
        $response = $this->signIn()->get('/posts');

        $response->assertStatus(200);
    }





}
