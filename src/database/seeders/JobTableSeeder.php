<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // １－６月の１－１０日分の打刻
        for($month=1; $month<=6; $month++) {
            for($day=1; $day<=10; $day++){
                for($id=1; $id <= 21; $id++){
                    $param = [
                    'user_id' => $id,
                    'start_job'=>new DateTime('2024-'.$month.'-'. $day . ' 09:00:00'),
                    'end_job'=>new DateTime('2024-'.$month.'-'. $day . ' 17:00:00'),
                    'status'=> 0
                    ];
                DB::table('jobs')->insert($param);
                }
            }
        }

        // 前日の打刻
        for($id=1; $id <= 21; $id++){
                    $time = new DateTime();
                    $param = [
                    'user_id' => $id,
                    'start_job'=>new DateTime( $time->modify('-1 days')->format('Y-m-d').' 09:00:00'),
                    'end_job'=>new DateTime( $time->modify('-1 days')->format('Y-m-d'). ' 17:00:00'),
                    'status'=> 0
                    ];
                DB::table('jobs')->insert($param);
        }

        // 今日の打刻
        for($id=1; $id <= 21; $id++){
                    $time = new DateTime();
                    $param = [
                    'user_id' => $id,
                    'start_job'=>new DateTime( $time->format('Y-m-d').' 09:00:00'),
                    'end_job'=>new DateTime( $time->format('Y-m-d'). ' 17:00:00'),
                    'status'=> 0
                    ];
                DB::table('jobs')->insert($param);
        }
    }
}