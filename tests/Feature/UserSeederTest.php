<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UsersSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserSeederTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_seeder_inserted()
    {

        $this->seed(UsersSeeder::class);

        $this->assertDatabaseHas('users', ['name' => 'Leanne Graham', 'id' => 1, 'username' => 'Bret', 'email' => 'Sincere@april.biz', 'phone' => '1-770-736-8031 x56442', 'website' => 'hildegard.org' ]);
        $this->assertDatabaseHas('user_addresses' , ['user_id' => 1, 'street' => 'Kulas Light']);
        $this->assertDatabaseHas('companies', ['name' => 'Romaguera-Crona']);

        $this->assertNotNull(User::find(1)->company);
        $this->assertNotNull(User::find(1)->address);
    }
}
