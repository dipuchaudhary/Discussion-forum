<?php

namespace App;


use App\Notifications\MarkBestReply;
use Illuminate\Database\Eloquent\Model;
use App\Reply;

class Discussion extends Model
{
    protected $fillable = [
      'title','content','slug','channel_id','user_id','reply_id'
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

    public function scopefilterByChannels($builder){

        if (request()->query('channel')){
            $channel = Channel::where('slug',request()->query('channel'))->first();

            if ($channel){
                return $builder->where('channel_id',$channel->id);
            }
            return $builder;
        }
        return $builder;
    }

    public function getBestReply(){
        return $this->belongsTo('App\Reply','reply_id');
    }

    public function markAsBestReply(Reply $reply){
         $this->update([
            'reply_id' => $reply->id,
        ]);

         if($reply->owner->id == $this->author->id){
             return;
         }
         $reply->owner->notify(new MarkBestReply($reply->discussion));
    }
}
