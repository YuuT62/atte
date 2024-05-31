<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Rest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RestController extends Controller
{
    public function start(Request $request){
        $start=$request->only('job_id');
        $start['start_rest']=new Carbon('now','Asia/Tokyo');
        $start['status']=1;
        Rest::create($start);
        return redirect('/');
    }

        public function end(Request $request){
        $end=$request->only(['job_id']);
        $end['end_rest']=new Carbon('now','Asia/Tokyo');
        $end['status']=0;
        Rest::query()->JobSearch($end['job_id'])->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->first()->update($end);
        return redirect('/');
    }

}
