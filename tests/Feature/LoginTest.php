<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_login_with_correct_credentials()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'secret'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(302);

        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)
            ->get('/login');

        $response->assertStatus(302);
    }

    public function test_a_user_can_login_with_a_username()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'secret'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->username,
            'password' => $password,
        ]);

        $response->assertStatus(302);

        $this->assertAuthenticatedAs($user);
    }

    public function test_a_user_cannot_login_with_invalid_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('secret'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email . 'sddd',
            'password' => 'invalid'
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors('email');

        $this->assertGuest();
    }
}
