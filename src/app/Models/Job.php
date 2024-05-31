<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'user_id',
        'start_job',
        'end_job',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeUserSearch($query, $user_id){
        if(!empty($user_id)){
            $query->where('user_id', $user_id);
        }
    }

    public function scopeDateSearch($query, $date){
        if(!empty($date)){
            $query->where('start_job', 'like', '%' . $date . '%');
        }
    }

    public function scopeJobSearch($query, $id){
        if(!empty($id)){
            $query->where('id', $id);
        }
    }

    public function rest(){
        return $this->hasMany(Rest::class);
    }
}
