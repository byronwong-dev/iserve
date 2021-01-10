<?php

namespace Tests\Feature;

use Database\Seeders\UserTodoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTodoSeederTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function check_seeder_inserted()
    {
        $this->seed(UserTodoSeeder::class);

        $this->assertDatabaseHas('todos', ['user_id' => 1, 'id' => 1, 'title' => 'delectus aut autem', 'completed' => 0]);
        $this->assertDatabaseCount('todos', 200);
    }
}
