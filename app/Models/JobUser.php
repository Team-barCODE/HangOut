<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobUser extends Model
{
    //
    //
    protected $fillable = ['user_id', 'job_id'];
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'job_user';
    public $timestamps = false;

    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


}
