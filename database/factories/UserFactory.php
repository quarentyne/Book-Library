<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $this->faker->password(9),
        ];
    }

    public function admin()
    {
        return $this->afterCreating(function (User $user) {
            $role = Role::firstOrCreate(['name' => 'admin']);
            $user->assignRole($role);
        });
    }

    public function writer()
    {
        return $this->afterCreating(function (User $user) {
            $role = Role::firstOrCreate(['name' => 'writer']);
            $user->assignRole($role);
        });
    }
}
