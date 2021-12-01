<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\LoginOTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Notification;

class SmsController extends Controller
{
    public function create(User $user)
    {
        $otp = rand(1000, 9999);

        FacadesNotification::sendNow($user, new LoginOTP());
    }
}
