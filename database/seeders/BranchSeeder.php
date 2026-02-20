<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('branches')->insert([
            [
                'name' => 'Main Branch',
                'code' => 'MAIN',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
