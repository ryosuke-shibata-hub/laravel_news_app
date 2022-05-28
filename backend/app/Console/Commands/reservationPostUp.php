<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\ReservationPost;
use Illuminate\Support\Facades\Log;

class reservationPostUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reservationPostUp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '予約公開設定した記事で予約日時を過ぎた記事をアップする';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info("予約公開コマンドの開始");

        $now = carbon::now();
        $year = $now->year;
        $month = $now->month;
        if ($month >= 0 && $month < 10) {
            $month = '0'.$month;
        }
        $day = $now->day;
        if ($day >= 0 && $day < 10) {
            $day = '0'.$day;
        }
        $hour = $now->hour;
        if ($hour >= 0 && $hour < 10 ) {
            $hour = '0'.$hour;
        }
        $minute = $now->minute;
        if ($minute >= 0 && $minute < 10) {
            $minute = '0'.$minute;
        }

        $date = $year.$month.$day;
        $time = $hour.$minute.'00';

        $reservation_posts = ReservationPost::where([
            ['reservation_date','<=',$date],
        ])->get();

        foreach ($reservation_posts as $reservation_post) {
            $r_date = $reservation_post->reservation_date;
            $r_time = $reservation_post->reservation_time;

            if ($r_date < $date || $r_date === $date && $r_time < $time) {
                $post_id = $reservation_post->post_id;
                $post = Post::find($post_id);
                Log::debug("公開する記事".$post_id);
                $update_post = $post->fill(['publish_flg' => 1])->save();
                Log::debug("記事のステータス更新".$update_post);
                $delete_reservation_post = $reservation_post->delete($post_id);
                Log::debug("予約記事の削除".$delete_reservation_post);
            }else {
                return;
            }
        }

        Log::info('予約公開コマンドの実行終了');

        // return 0;
    }
}