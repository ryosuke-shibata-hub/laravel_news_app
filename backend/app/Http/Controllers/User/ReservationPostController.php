<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;
use App\Models\ReservationPost;

class ReservationPostController extends Controller
{
    private $post;
    private $category;
    private $reservationPost;

    public function __construct()
    {
        $this->post = new Post();
        $this->category = new Category();
        $this->reservationPost = new ReservationPost();
    }

    public function reservationSetting(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $title = $request->title;
        $body = $request->body;
        $category = $request->category;

        $minuteList = ['00','15','30','45'];

        return view('user.list.reservationSetting')
        ->with('user_id',$user_id)
        ->with('title',$title)
        ->with('body',$body)
        ->with('category',$category)
        ->with('minuteList',$minuteList);
    }

    public function reservationStore(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $post = $this->post->insertPostToSaveReservationRelease($user_id,$request);

        $date = $request->reservation_date;
        $reservation_date = str_replace('-','',$date);
        $hour = $request->reservation_hour;
        $minute = $request->reservation_minute;

        $reservation_time = $hour.$minute.'00';

        $reservation_Post = $this->reservationPost->insertReservationPostDate(
            $post,
            $reservation_date,
            $reservation_time,
        );

        $request->session()->flash('reservationRelease','記事を予約公開しました。');

        return to_route('user.index',['id' => $user_id]);
    }
}