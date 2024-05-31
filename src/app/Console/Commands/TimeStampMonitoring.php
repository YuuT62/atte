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
        $date= explode(' ',new Carbon('today', 'Asia/Tokyo'))[0];
        $jobs=Job::query()->DateSearch($date)->get();
        foreach($jobs as $job){
            if($job['status']){
                $end['user_id']=$job['user_id'];
                $end['end_job']=new Carbon($date.' 23:59:59');
                $end['status']=0;
                Job::query()->JobSearch($job['id'])->update($end);

                $start['user_id']=$job['user_id'];
                $start['start_job']=Carbon::today('Asia/Tokyo');
                $start['status']=1;
                Job::create($start);
            }
        }
    }
}
