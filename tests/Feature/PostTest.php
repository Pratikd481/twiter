<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use App\Repositories\Eloquent\PostRepository;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Mockery;
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

    /** @test */
    public function posts_create_should_work_with_valid_data()
    {

        $response = $this->signIn()->post('/posts', [
            'description' => 'test'
        ]);

        $response->assertRedirect('my-profile');
        $response->assertSessionDoesntHaveErrors();
    }

    /** @test */
    public function posts_create_should_not_work_with_wrong_data()
    {
        $response = $this->signIn()->post('/posts', [
            'description_wrong' => 'test'
        ]);
        $response->assertSessionHasErrors();
    }


    /** @test */
    public function posts_update_should_work_with_valid_data()
    {
        $this->signIn();
        $repo =  App::make(PostRepositoryInterface::class);
        $post =  $repo->create([
            'description' => 'testddd'
        ]);
        $response = $this->signIn()->put('/posts/' . $post->uuid, [
            'description' => 'test'
        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function posts_update_should_not_work_with_invalid_uuid()
    {
        $this->signIn();
        $repo =  App::make(PostRepositoryInterface::class);
        $post =  $repo->create([
            'description' => 'testddd'
        ]);
        $response = $this->signIn()->put('/posts/' . $post->uuid . 'wrong_uuid', [
            'description' => 'test'
        ]);

        $response->assertStatus(400);
    }

    /** @test */
    public function posts_update_should_not_work_with_blank_description()
    {
        $this->signIn();
        $repo =  App::make(PostRepositoryInterface::class);
        $post =  $repo->create([
            'description' => 'testddd'
        ]);
        $response = $this->put('/posts/' . $post->uuid, [
            'description' => ''
        ]);


        $response->assertStatus(422);
    }

    /** @test */
    public function posts_delete_should_work()
    {
        $this->signIn();
        $repo =  App::make(PostRepositoryInterface::class);
        $post =  $repo->create([
            'description' => 'testddd'
        ]);

        $response = $this->delete('/posts/' . $post->uuid);


        $response->assertStatus(200);
    }

    /** @test */
    public function posts_should_not_be_deleted_by_other_user()
    {
        $this->signIn();
        $repo =  App::make(PostRepositoryInterface::class);
        $post =  $repo->create([
            'description' => 'testddd'
        ]);

        $this->signIn();
        $response = $this->delete('/posts/' . $post->uuid);


        $response->assertStatus(400);
    }
}
