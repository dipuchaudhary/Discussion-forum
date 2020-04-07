<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function notifications(){
        //mark all as read
        auth()->user()->unreadNotifications->markAsRead();

        return view('users.notification', [
            'notifications' => auth()->user()->notifications()->paginate(3)
        ]);
    }
}
