<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_name_is_required()
    {
        // $this->withoutExceptionHandling();

        $response = $this->json('POST', '/register', [
            'name' => '',
            'email' => 'user@email.com',
            'password' => 'password',
            'username' => 'user.name',
            'password_confirmation' => 'password',
        ]);

        $response->assertJsonValidationErrors('name');
    }

    public function test_an_email_is_required_and_is_valid()
    {
        $response = $this->json('POST', '/register', [
            'name' => 'Johnn Doe',
            'email' => '',
            'username' => 'user.name',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response2 = $this->json('POST', '/register', [
            'name' => 'Johnn Doe',
            'email' => 'jkdsdswo1',
            'username' => 'user.name',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertJsonValidationErrors('email');
        $response2->assertJsonValidationErrors('email');
    }

    public function test_a_username_is_required()
    {
        $response = $this->json('POST', '/register', [
            'name' => 'John Doe',
            'email' => 'user@email.com',
            'username' => '',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertJsonValidationErrors('username');
    }

    public function test_a_user_can_register()
    {
        $this->withoutExceptionHandling();

        $response = $this->json('POST', '/register', [
            'name' => 'John Doe',
            'email' => 'user@email.com',
            'username' => 'user.name',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302);

        $user = User::first();

        $this->assertNotNull($user);

        $this->assertEquals('John Doe', $user->name);
    }
}
