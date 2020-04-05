<?php

namespace App;



class Reply extends Model
{

    public function owner(){
        return $this->belongsTo('App\User','user_id');
    }

    public function discussion(){
        return $this->belongsTo('App\Discussion');
    }
}
