<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = [
      'title','content','slug','channel_id','user_id'
    ];

    public function author(){
        return $this->belongsTo('App\User','user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function replies(){
        return $this->hasMany('App\Reply');
    }
}
