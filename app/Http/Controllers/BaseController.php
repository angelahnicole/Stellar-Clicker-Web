<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as LaravelBaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// ===============================================================================================================
// 
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// 
// ===============================================================================================================
class BaseController extends LaravelBaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public static function processNotifications()
    {
        $successNotes = session('successNotes');
        $errorNotes = session('errorNotes');
        
        if($successNotes)
        {
            foreach($successNotes as $notification)
            {
                \Notification::successInstant($notification);
            }
        }
        
        if($errorNotes)
        {
            foreach($errorNotes as $notification)
            {
                \Notification::errorInstant($notification);
            }
        }
        
        session()->forget('successNotes');
        session()->forget('errorNotes');
    }
    
    public static function addNotification($notification, $type)
    {
        switch($type)
        {
            case 'success': session()->push('successNotes', $notification); break;
            case 'error': session()->push('errorNotes', $notification); break;
        }
    }
}
