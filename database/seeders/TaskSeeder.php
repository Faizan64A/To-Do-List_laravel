<?php

namespace Database\Seeders;

use App\Models\ToDoData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ToDoData::factory()->count(100)->create();
    }
}
