<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(PostsTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        $this->call(MalfunctionsTableSeeder::class);
    
        // factory(\App\User::class, 10)->create();
    }
}
