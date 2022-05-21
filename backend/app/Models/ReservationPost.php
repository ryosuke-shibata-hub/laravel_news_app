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
}