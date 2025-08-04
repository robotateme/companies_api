<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Building;
use App\Models\Company;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        DB::table('company_activity')->truncate();
        DB::table('company_activity')->insert([
            [
                'company_id' => 5,
                'activity_id' => 4,
            ],
            [
                'company_id' => 1,
                'activity_id' => 1,
            ],
            [
                'company_id' => 4,
                'activity_id' => 7,
            ],
            [
                'company_id' => 4,
                'activity_id' => 8,
            ],
        ]);


    }
}
