<?php

use Illuminate\Database\Seeder;

class MalfunctionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Malfunction::class, 10)->create();
    }
}
