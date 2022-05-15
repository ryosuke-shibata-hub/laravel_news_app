<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'body',
        'publish_flg',
        'view_counter',
        'favorite_counter',
        'delete_flg',
        'created_at',
        'updated_at',
    ];

    //ユーザーIDに紐づいた投稿リストを全権取得
    public function getAllPostsByUserId($user_id)
    {
        $result = $this->where('user_id',$user_id)
        ->with('category')->get();

        return $result;
    }

    //categoryとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //下書き保存のロジック
    //publish_flg = 0
    public function insertPostToSaveDraft($user_id,$request)
    {
        $result = $this->create([
            'user_id' => $user_id,
            'category_id' => $request->category,
            'title' => $request->title,
            'body' => $request->body,
            'publish_flg' => 0,
            'view_counter' => 0,
            'favorite_counter' => 0,
            'delete_flg' => 0,
        ]);

        return $result;
    }

    //公開のロジック
    //publish_flg = 1
    public function insertPostToSaveRelease($user_id,$request)
    {
        $result = $this->create([
            'user_id' => $user_id,
            'category_id' => $request->category,
            'title' => $request->title,
            'body' => $request->body,
            'publish_flg' => 1,
            'view_counter' => 0,
            'favorite_counter' => 0,
            'delete_flg' => 0,
        ]);

        return $result;
    }

    //予約公開のロジック
    //publish_flg = 2
    public function insertPostToSaveReservationRelease($user_id,$request)
    {
        $result = $this->create([
            'user_id' => $user_id,
            'category_id' => $request->category,
            'title' => $request->title,
            'body' => $request->body,
            'publish_flg' => 2,
            'view_counter' => 0,
            'favorite_counter' => 0,
            'delete_flg' => 0,
        ]);

        return $result;
    }
}