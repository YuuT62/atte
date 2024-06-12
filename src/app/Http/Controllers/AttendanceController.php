<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Rest;
use App\Models\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function attendance(Request $request){
        $date=$request->session()->get('date');
        if(isset($date)){
            $date=explode(' ',$date)[0];
        }
        else{
            $date=explode(' ',new Carbon('today', 'Asia/Tokyo'))[0];
        }
        $jobs=Job::with('user')->DateSearch($date)->Paginate(5);
        $rest_result=[];
        $job_result=[];

        foreach($jobs as $job){
            // 休憩時間の合計
            $rest_total=0;
            $rests= Rest::query()->JobSearch($job['id'])->get();
            foreach($rests as $rest){
                $start_rest=new Carbon($rest['start_rest']);
                $end_rest=new Carbon($rest['end_rest']);
                $diffInSeconds=$start_rest->diffInSeconds($end_rest);
                $rest_total += $diffInSeconds;
            }
            $rest_result[$job['id']] = sprintf('%02d',floor($rest_total/3600)).':'.sprintf('%02d',floor(($rest_total%3600)/60 )).':'.sprintf('%02d',($rest_total%60));


            // 勤務時間の合計
            $start_job=new Carbon($job['start_job']);
            $end_job=new Carbon($job['end_job']);
            $job_total=($start_job->diffInSeconds($end_job)) - $rest_total;
            $job_result[$job['id']] = sprintf('%02d',floor($job_total/3600)).':'.sprintf('%02d',floor(($job_total%3600)/60 )).':'.sprintf('%02d',($job_total%60));
        }

        return view('attendance', compact('jobs', 'rest_result', 'job_result', 'date'));
    }






    // public function yesterday(Request $request){
    //     $date = new Carbon($request["date"]);
    //     $date = $date->subDays(1);
    //     return redirect('/attendance')->with(compact('date'));
    // }

    public function yesterday(Request $request){
        $date = new Carbon($request["date"]);
        $date = $date->subDays(1);
        if(isset($date)){
            $date=explode(' ',$date)[0];
        }
        else{
            $date=explode(' ',new Carbon('today', 'Asia/Tokyo'))[0];
        }
        $jobs=Job::with('user')->DateSearch($date)->Paginate(5);
        $rest_result=[];
        $job_result=[];

        foreach($jobs as $job){
            // 休憩時間の合計
            $rest_total=0;
            $rests= Rest::query()->JobSearch($job['id'])->get();
            foreach($rests as $rest){
                $start_rest=new Carbon($rest['start_rest']);
                $end_rest=new Carbon($rest['end_rest']);
                $diffInSeconds=$start_rest->diffInSeconds($end_rest);
                $rest_total += $diffInSeconds;
            }
            $rest_result[$job['id']] = sprintf('%02d',floor($rest_total/3600)).':'.sprintf('%02d',floor(($rest_total%3600)/60 )).':'.sprintf('%02d',($rest_total%60));


            // 勤務時間の合計
            $start_job=new Carbon($job['start_job']);
            $end_job=new Carbon($job['end_job']);
            $job_total=($start_job->diffInSeconds($end_job)) - $rest_total;
            $job_result[$job['id']] = sprintf('%02d',floor($job_total/3600)).':'.sprintf('%02d',floor(($job_total%3600)/60 )).':'.sprintf('%02d',($job_total%60));
        }

        return view('attendance', compact('jobs', 'rest_result', 'job_result', 'date'));
    }


    // public function tomorrow(Request $request){
    //     $date = new Carbon($request["date"]);
    //     $date = $date->addDays(1);
    //     return redirect('/attendance')->with(compact('date'));
    // }
    public function tomorrow(Request $request){
        $date = new Carbon($request["date"]);
        $date = $date->addDays(1);
        if(isset($date)){
            $date=explode(' ',$date)[0];
        }
        else{
            $date=explode(' ',new Carbon('today', 'Asia/Tokyo'))[0];
        }
        $jobs=Job::with('user')->DateSearch($date)->Paginate(5);
        $rest_result=[];
        $job_result=[];

        foreach($jobs as $job){
            // 休憩時間の合計
            $rest_total=0;
            $rests= Rest::query()->JobSearch($job['id'])->get();
            foreach($rests as $rest){
                $start_rest=new Carbon($rest['start_rest']);
                $end_rest=new Carbon($rest['end_rest']);
                $diffInSeconds=$start_rest->diffInSeconds($end_rest);
                $rest_total += $diffInSeconds;
            }
            $rest_result[$job['id']] = sprintf('%02d',floor($rest_total/3600)).':'.sprintf('%02d',floor(($rest_total%3600)/60 )).':'.sprintf('%02d',($rest_total%60));


            // 勤務時間の合計
            $start_job=new Carbon($job['start_job']);
            $end_job=new Carbon($job['end_job']);
            $job_total=($start_job->diffInSeconds($end_job)) - $rest_total;
            $job_result[$job['id']] = sprintf('%02d',floor($job_total/3600)).':'.sprintf('%02d',floor(($job_total%3600)/60 )).':'.sprintf('%02d',($job_total%60));
        }

        return view('attendance', compact('jobs', 'rest_result', 'job_result', 'date'));
    }


    public function user_list(){
        $users=User::with('job')->Paginate(5);
        return view('user_list' ,compact('users'));
    }



    public function user(Request $request){
        $date=$request->session()->get('date');
        $user_id=$request['user_id'];
        $user_name=$request['user_name'];
        if(isset($date)){
            $date=substr(explode(' ',$date)[0], 0, -3);
        }
        else{
            $date=substr(explode(' ',new Carbon('today', 'Asia/Tokyo'))[0], 0, -3);
        }
        $jobs=Job::query()->UserSearch($user_id)->DateSearch($date)->Paginate(5);
        $rest_result=[];
        $job_result=[];

        foreach($jobs as $job){
            // 休憩時間の合計
            $rest_total=0;
            $rests= Rest::query()->JobSearch($job['id'])->get();
            foreach($rests as $rest){
                $start_rest=new Carbon($rest['start_rest']);
                $end_rest=new Carbon($rest['end_rest']);
                $diffInSeconds=$start_rest->diffInSeconds($end_rest);
                $rest_total += $diffInSeconds;
            }
            $rest_result[$job['id']] = sprintf('%02d',floor($rest_total/3600)).':'.sprintf('%02d',floor(($rest_total%3600)/60 )).':'.sprintf('%02d',($rest_total%60));


            // 勤務時間の合計
            $start_job=new Carbon($job['start_job']);
            $end_job=new Carbon($job['end_job']);
            $job_total=($start_job->diffInSeconds($end_job)) - $rest_total;
            $job_result[$job['id']] = sprintf('%02d',floor($job_total/3600)).':'.sprintf('%02d',floor(($job_total%3600)/60 )).':'.sprintf('%02d',($job_total%60));
        }

        return view('user', compact('jobs', 'rest_result', 'job_result', 'date', 'user_id', 'user_name'));
    }

    public function last_month(Request $request){
        $date = new Carbon($request["date"]);
        $user_id=$request['user_id'];
        $user_name=$request['user_name'];
        $date = $date->subMonths(1);
        if(isset($date)){
            $date=substr(explode(' ',$date)[0], 0, -3);
        }
        else{
            $date=substr(explode(' ',new Carbon('today', 'Asia/Tokyo'))[0], 0, -3);
        }
        $jobs=Job::query()->UserSearch($request['user_id'])->DateSearch($date)->Paginate(5);
        $rest_result=[];
        $job_result=[];

        foreach($jobs as $job){
            // 休憩時間の合計
            $rest_total=0;
            $rests= Rest::query()->JobSearch($job['id'])->get();
            foreach($rests as $rest){
                $start_rest=new Carbon($rest['start_rest']);
                $end_rest=new Carbon($rest['end_rest']);
                $diffInSeconds=$start_rest->diffInSeconds($end_rest);
                $rest_total += $diffInSeconds;
            }
            $rest_result[$job['id']] = sprintf('%02d',floor($rest_total/3600)).':'.sprintf('%02d',floor(($rest_total%3600)/60 )).':'.sprintf('%02d',($rest_total%60));


            // 勤務時間の合計
            $start_job=new Carbon($job['start_job']);
            $end_job=new Carbon($job['end_job']);
            $job_total=($start_job->diffInSeconds($end_job)) - $rest_total;
            $job_result[$job['id']] = sprintf('%02d',floor($job_total/3600)).':'.sprintf('%02d',floor(($job_total%3600)/60 )).':'.sprintf('%02d',($job_total%60));
        }

        return view('user', compact('jobs', 'rest_result', 'job_result', 'date', 'user_id', 'user_name'));
    }

    public function next_month(Request $request){
        $date = new Carbon($request["date"]);
        $user_id=$request['user_id'];
        $user_name=$request['user_name'];
        $date = $date->addMonths(1);
        if(isset($date)){
            $date=substr(explode(' ',$date)[0], 0, -3);
        }
        else{
            $date=substr(explode(' ',new Carbon('today', 'Asia/Tokyo'))[0], 0, -3);
        }
        $jobs=Job::query()->UserSearch($request['user_id'])->DateSearch($date)->Paginate(5);
        $rest_result=[];
        $job_result=[];

        foreach($jobs as $job){
            // 休憩時間の合計
            $rest_total=0;
            $rests= Rest::query()->JobSearch($job['id'])->get();
            foreach($rests as $rest){
                $start_rest=new Carbon($rest['start_rest']);
                $end_rest=new Carbon($rest['end_rest']);
                $diffInSeconds=$start_rest->diffInSeconds($end_rest);
                $rest_total += $diffInSeconds;
            }
            $rest_result[$job['id']] = sprintf('%02d',floor($rest_total/3600)).':'.sprintf('%02d',floor(($rest_total%3600)/60 )).':'.sprintf('%02d',($rest_total%60));


            // 勤務時間の合計
            $start_job=new Carbon($job['start_job']);
            $end_job=new Carbon($job['end_job']);
            $job_total=($start_job->diffInSeconds($end_job)) - $rest_total;
            $job_result[$job['id']] = sprintf('%02d',floor($job_total/3600)).':'.sprintf('%02d',floor(($job_total%3600)/60 )).':'.sprintf('%02d',($job_total%60));
        }

        return view('user', compact('jobs', 'rest_result', 'job_result', 'date', 'user_id', 'user_name'));
    }

}
