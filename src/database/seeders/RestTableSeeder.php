<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class RestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // １－６月の１－１０日分の打刻
        $id=1;
        for($month=1; $month<=6; $month++) {
            for($day=1; $day<=10; $day++){
                for($i=1; $i <= 21; $i++){
                    $param = [
                    'job_id' => $id,
                    'start_rest'=>new DateTime('2024-'.$month.'-'. $day . ' 12:00:00'),
                    'end_rest'=>new DateTime('2024-'.$month.'-'. $day . ' 13:00:00'),
                    'status'=> 0
                    ];
                DB::table('rests')->insert($param);
                $id++;
                }
            }
        }

        // 今日の打刻
        for($i=1; $i <= 21; $i++){
                    $time = new DateTime();
                    $param = [
                    'job_id' => $id,
                    'start_rest'=>new DateTime( $time->modify('-1 days')->format('Y-m-d').' 12:00:00'),
                    'end_rest'=>new DateTime( $time->modify('-1 days')->format('Y-m-d'). ' 13:00:00'),
                    'status'=> 0
                    ];
                DB::table('rests')->insert($param);
                $id++;
        }

        // 今日の打刻
        for($i=1; $i <= 21; $i++){
                    $time = new DateTime();
                    $param = [
                    'job_id' => $id,
                    'start_rest'=>new DateTime( $time->format('Y-m-d').' 12:00:00'),
                    'end_rest'=>new DateTime( $time->format('Y-m-d'). ' 13:00:00'),
                    'status'=> 0
                    ];
                DB::table('rests')->insert($param);
                $id++;
        }
    }
}
