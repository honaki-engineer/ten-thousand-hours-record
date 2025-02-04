<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_forms')->insert([
            [
                'date' => '2025-02-02',
                'study_seconds' => 11111,
                'status' => 1,
                'comment' => 'あああ',
                'user_id' => 1,
                'created_at' => now(),
            ],
            [
                'date' => '2025-02-03',
                'study_seconds' => 22222,
                'status' => 3,
                'comment' => 'いいい',
                'user_id' => 2,
                'created_at' => now(),
                ]
        ]);
    }
}
