<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationPost extends Model
{
    use HasFactory;
    protected $table = 'reservation_posts';

    protected $fillable = [
        'user_id',
        'post_id',
        'reservation_date',
        'reservation_time',
        'created_at',
        'updated_at',
    ];

    public function insertReservationPostDate($post,$reservation_date,$reservation_time)
    {
        return $this->create([
            'user_id' => $post->user_id,
            'post_id' => $post->id,
            'reservation_date' => $reservation_date,
            'reservation_time' => $reservation_time,
        ]);
    }

    public function getReservationPostByUserIdAndPostId($user_id,$post_id)
    {
        return $this->where([
            ['user_id',$user_id],
            ['post_id',$post_id],
        ])
        ->first();
    }

    public function updateReservationPost($reservationPost,$reservation_date,$reservation_time)
    {
        return $reservationPost->fill([
            'reservation_date' => $reservation_date,
            'reservation_time' => $reservation_time,
        ])->save();
    }

    public function deleteData($reservationPost)
    {
        return $reservationPost->delete();
    }
}