<?php

namespace Tests\Feature;

use Database\Seeders\UsersSeeder;
use Database\Seeders\UserTodoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoSearchTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    public function api_search_for_todo()
    {
        $this->seed(UsersSeeder::class);
        $this->seed(UserTodoSeeder::class);

        $response = $this->json('get', '/search', [
            'query' => 'delectus',
        ]);

        $this->assertCount(7, $response['data']);
        $response->assertJsonFragment([
            "userId" => '1',
            "id" => 1,
            "title" => "delectus aut autem",
            "completed" => false
        ]);
    }
}
