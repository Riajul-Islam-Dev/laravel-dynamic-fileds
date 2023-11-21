<?php

namespace Database\Seeders;

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
        // Uncomment the line below if you want to use the User factory
        // \App\Models\User::factory(10)->create();

        // Call the TaskSeeder to seed the tasks table
        $this->call(TaskSeeder::class);
    }
}
