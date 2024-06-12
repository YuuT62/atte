<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Rest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class JobController extends Controller
{
    public function index(){
        $job_status=Job::query()->UserSearch(Auth::user()->id)->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->first();
        $rest_status=[];
        if(isset($job_status)){
            $rest_status=Rest::query()->JobSearch($job_status['id'])->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->first();
        }
        // $test=Job::UserSearch(Auth::user()->id)->get()->only('start_job');
        // $test=Auth::user()->id;
        // $test=User::get()->only('id');
        return view('index', compact('job_status', 'rest_status'));
    }

    public function start(Request $request){
        // $start=$request->only(['user_id']);
        $start['user_id']=Auth::user()->id;
        $start['start_job']=new Carbon('now','Asia/Tokyo');
        $start['status']=1;
        Job::create($start);
        return redirect('/');
    }

    public function end(Request $request){
        $end['user_id']=Auth::user()->id;
        $end['end_job']=new Carbon('now','Asia/Tokyo');
        $end['status']=0;
        Job::query()->UserSearch(Auth::user()->id)->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->first()->update($end);
        return redirect('/');
    }

    public function verify(){
        return view('verify-email');
    }

}
