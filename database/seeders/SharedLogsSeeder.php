<?php

namespace Database\Seeders;

use App\Models\Log;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SharedLogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::truncate();

        DB::table('shared_logs')->insert([
            'project' => 'Bee Active',
            'username' => 'Anders',
            'environment' => 'Development',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        DB::table('shared_logs')->insert([
            'project' => 'Bee Active',
            'username' => 'Anders',
            'environment' => 'Development',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);
    }
}
