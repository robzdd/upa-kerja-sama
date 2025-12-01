<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MitraNotificationController extends Controller
{
    public function markAsRead()
    {
        auth()->guard('mitra')->user()->unreadNotifications->markAsRead();
        return back();
    }
}
