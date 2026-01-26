<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_user_create(): void
    {
        Role::create([
            'name' => 'writer',
            'guard_name' => 'web',
        ]);

        $password = fake()->password(8);

        $user = [
           'firstname' => fake()->firstname(),
           'lastname' => fake()->lastname(),
           'email' => fake()->email(),
           'password' => $password,
           'password_confirmation' => $password,
        ];

        $response = $this->json('POST', '/register', $user);

        $response->assertStatus(201);
    }

    public function test_user_login(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $this->assertAuthenticated();

        $response->assertStatus(200);
    }
}
