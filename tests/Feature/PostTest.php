<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_all_posts()
    {
        $user = factory(User::class)->create();
        factory(Post::class)->create();
        $this->actingAs($user,"api");
        $this->get("api/posts")->assertStatus(200);

    }

    public function test_post_not_exist()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();
        $response = $this->actingAs($user,"api")->get("/api/posts/1000");
        $response->assertStatus(404);
    }

    public function test_get_single_post()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();
        $response = $this->actingAs($user,"api")->get("/api/posts/$post->id");
        $response->assertStatus(200);

    }

    public function test_create_new_post()
    {
        $post     = factory(Post::class)->create();
        $user     = factory(User::class)->create();
        $response = $this->actingAs($user,"api")->post("api/posts",$post->toArray());
        $response->assertStatus(201);
    }

    public function test_update_post()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
           "title" => "test",
           "body"  => "test"
        ]);
        $arr = [
          "title" => "test2",
          "body"  => "test2"
        ];

        $response = $this->actingAs($user,"api")->put("api/posts/$post->id",$arr);
        $response->assertStatus(201);
    }

    public function test_delete_post()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();
        $response = $this->actingAs($user,"api")->delete("api/posts/$post->id");
        $response->assertStatus(204);
    }

}
