<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
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
        User::factory()->times(1)->create([
            "name" => "widePay",
            "email" => "wide@wide.com",
            "password" => bcrypt("senhas")
        ]);
        Project::factory()->times(40)->create();
    }
}
