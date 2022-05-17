<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Carbon;

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

    //Userとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //categoryとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //ユーザーIDに紐づいた投稿リストを全権取得
    public function getAllPostsByUserId($user_id)
    {
        $result = $this->where([
            ['user_id',$user_id],
            ['delete_flg',0],
            ])
            ->with('category')
            ->orderby('updated_at','desc')
            ->get();

        return $result;
    }

    //投稿データの全取得&投稿順にソート&総合トップに表示する記事は「公開」ステータス
    public function getPostsSortByLatestUpdate()
    {
        $result = $this->where([
                        ['publish_flg',1],
                        ['delete_flg',0],
                        ])
                       ->orderby('updated_at','desc')
                       ->with('user')
                       ->with('category')
                       ->get();

        return $result;

    }

    //トップ画面カテゴリごとの表示
    public function getPostByCategoryId($category_id)
    {
        $result = $this->where('category_id',$category_id)
                       ->get();

        return $result;
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

    public function feachPostDateByPostId($post_id)
    {
        $result = $this->find($post_id);

        return $result;
    }

    public function updatePostToSaveDraft($request,$post)
    {
        // dd($post);
        $result = $post->fill([
            'category_id' => $request->category,
            'title' => $request->title,
            'body' => $request->body,
            'publish_flg' => 0,
        ]);

        $result->save();

        return $result;
    }

    public function updatePostToRelease($request,$post)
    {
        $result = $post->fill([
            'category_id' => $request->category,
            'title' => $request->title,
            'body' => $request->body,
            'publish_flg' => 1,
        ]);

        $result->save();

        return $result;
    }

        public function updatePostToReservationRelease($request,$post)
    {
        $result = $post->fill([
            'category_id' => $request->category,
            'title' => $request->title,
            'body' => $request->body,
            'publish_flg' => 2,
        ]);

        $result->save();

        return $result;
    }

    //ゴミ箱の一覧
    public function getTrashPostLists($user_id)
    {
        $result = $this->where([
            ['user_id',$user_id],
            ['delete_flg',1],
        ])->get();

        return $result;
    }

    public function moveTrashPostData($post)
    {
        $result = $post->fill([
            'publish_flg' => 0,
            'delete_flg' => 1,
        ]);
        $result->save();

        return $result;
    }

    public function restorePostData($post)
    {
        $result = $post->fill([
            'publish_flg' => 0,
            'delete_flg' => 0,
        ]);

        $result->save();

        return $result;
    }

    public function deletePostData($post)
    {
        $result = $post->delete();
        return $result;
    }
}