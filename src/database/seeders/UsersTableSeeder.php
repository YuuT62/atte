<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use DateTime;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'password' => bcrypt('P@ssw0rd'),
            'email_verified_at' => new DateTime('2024-01-01'),
        ];
        DB::table('users')->insert($param);

        User::factory()->count(20)->create();
    }
}
