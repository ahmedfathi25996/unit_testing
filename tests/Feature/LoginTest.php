<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_require_validation_login()
    {
       $this->json('POST','api/login')
           ->assertStatus(422)->assertJson([
               "message" => "The given data was invalid."
           ]);
    }


    public function test_invalid_login()
    {
        $user = factory(User::class)->create();

        $arr = [
            "email" => $user->email,
            "password" => "123456"
        ];

        $this->post("api/login",$arr)->assertStatus(404);
    }

    public function test_login_successfully()
    {

       $user = factory(User::class)->create();

        $arr = [
            "email" => $user->email,
            "password" => "123"
        ];

        $this->post("api/login",$arr)->assertStatus(200);

    }
}
