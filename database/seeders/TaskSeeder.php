<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing data
        DB::table('tasks')->truncate();

        // Seed with sample data
        $tasks = [
            ['task_name' => 'Sample Task 1', 'description' => 'Description for Task 1'],
            ['task_name' => 'Sample Task 2', 'description' => 'Description for Task 2'],
            // Add more tasks as needed
        ];

        // Insert the data into the tasks table
        DB::table('tasks')->insert($tasks);
    }
}
