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
}