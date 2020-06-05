<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'reports';

    public $incrementing = false;  // インクリメントIDを無効化
    public $timestamps = false; // update_at, created_at を無効化

    // Relation
    public function reportToUser()
    {
        return $this->belongsTo('App\Models\User', 'to_user_id', 'id');
    }

    public function reportFromUser()
    {
        return $this->belongsTo('App\Models\User', 'from_user_id', 'id');
    }
}
