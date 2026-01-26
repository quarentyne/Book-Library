<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    protected Model $admin;
    protected Model $writer;

    protected array $author;


    use RefreshDatabase;

    /**
     * A basic feature test example.
     */

    protected function setUp(): void
    {
        parent::setUp();

        Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'writer',
            'guard_name' => 'web',
        ]);

        $this->admin = User::factory()->admin()->create();
        $this->writer = User::factory()->writer()->create();

        $this->author = [
            'lastname' => fake()->lastName,
            'firstname' => fake()->firstName,
            'middlename' => '',
        ];
    }

    public function test_create_author_as_admin(): void
    {
        $response = $this->actingAs($this->admin)->post('/authors', $this->author);

        $response->assertStatus(201);
    }

    public function test_create_author_as_writer(): void
    {
        $response = $this->actingAs($this->writer)->post('/authors', $this->author);

        $response->assertStatus(403);
    }
}
