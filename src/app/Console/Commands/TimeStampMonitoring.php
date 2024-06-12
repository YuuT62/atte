<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;
use App\Models\Rest;
use Carbon\Carbon;

class TimeStampMonitoring extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:time_stamp_monitoring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Time stamp management when dates change';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date= explode(' ',new Carbon('yesterday', 'Asia/Tokyo'))[0];
        // yesterdayに修正（test中のためtoday）↑
        $jobs=Job::query()->DateSearch($date)->get();
        foreach($jobs as $job){
            if($job['status']){
                $rest=Rest::query()->JobSearch($job['id'])->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->first();

                if(isset($rest) && $rest['status']){
                    $end_rest['status']=0;
                    $end_rest['end_rest']=new Carbon($date.' 23:59:59');
                    Rest::query()->RestSearch($rest['id'])->update($end_rest);
                }
                $end['user_id']=$job['user_id'];
                $end['end_job']=new Carbon($date.' 23:59:59');
                $end['status']=0;
                Job::query()->JobSearch($job['id'])->update($end);

                $start['user_id']=$job['user_id'];
                $start['start_job']=Carbon::today('Asia/Tokyo');
                $start['status']=1;
                Job::create($start);

                if(isset($rest) && $rest['status']){
                    $new_job=Job::query()->UserSearch($job['user_id'])->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->first();
                    $start_rest['job_id']=$new_job['id'];
                    $start_rest['start_rest']=Carbon::today('Asia/Tokyo');
                    $start_rest['status']=1;
                    Rest::create($start_rest);
                }
            }
        }
    }
}
