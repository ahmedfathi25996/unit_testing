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
    public function testLoginValidation()
    {
       $this->json('POST','api/login')
           ->assertStatus(422);
    }

    public function testLoginSuccessfully()
    {

       $user = factory(User::class)->create();

        $arr = [
            "email" => $user->email,
            "password" => "123"
        ];

        $this->post("api/login",$arr)->assertStatus(200);

    }
}
