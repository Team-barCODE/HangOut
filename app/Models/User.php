<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'self_introduction', 'sex', 'img_name1', 'birth_date', 'prefecture',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // reactionのリレーション
    public function toUserId()
    {
        return $this->hasMany('App\Models\Reaction', 'to_user_id', 'id');
    }

    public function fromUserId()
    {
        return $this->hasMany('App\Models\Reaction', 'from_user_id', 'id');
    }

    // リアルタイムチャットのリレーション
    public function chatMessages()
    {
        return $this->hasMany('App\Models\ChatMessage');
    }

    public function chatRoomUsers()
    {
        return $this->hasMany('App\Models\ChatRoomUsers');
    }

    // 趣味用
    public function genreId()
    {
        return $this->hasMany('App\Models\HobbyUser');
    }

    // 性格
    public function personalityId()
    {
        return $this->hasMany('App\Models\PersonalityUser');
    }

    // 職種
    public function jobId()
    {
        return $this->hasMany('App\Models\JobUser');
    }

    // 趣味用
    public function genreId2()
    {
        return $this->belongsToMany('App\Models\Hobby');
    }

    // 性格
    public function personalityId2()
    {
        return $this->belongsToMany('App\Models\Personality');
    }

    // 職種
    public function jobId2()
    {
        return $this->belongsToMany('App\Models\Job');
    }

}
