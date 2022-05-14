<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Auth;

class TopController extends Controller
{
    //

    public function top()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user_id = $user->id;
        }else {
            $user_id = null;
        }

        return view('top')
        ->with('user_id',$user_id);
    }
}