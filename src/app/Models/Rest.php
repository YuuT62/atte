<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    protected $fillable =[
        'job_id',
        'start_rest',
        'end_rest',
        'status'
    ];

    public function job(){
        return $this->belongsTo(Job::class);
    }

    public function scopeJobSearch($query, $job_id){
        if(!empty($job_id)){
            $query->where('job_id', $job_id);
        }
    }

    // public function total($job_id){
    //     if(!empty($job_id)){
    //         $rests=$this->where('job_id', $job_id);
    //         $result=10;
    //         foreach($rests as $rest){
    //             $diffInSeconds=$rest['start_rest']->diffInSeconds($rest['end_rest']);
    //             $result =11;
    //         }
    //     }
    //     return $result;
    // }
}
