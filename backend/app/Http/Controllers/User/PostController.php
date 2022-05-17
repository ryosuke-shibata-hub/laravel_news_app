<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Auth;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    private $post;

    public function __construct()
    {
        $this->post = new Post();
        $this->category = new Category();
    }

    public function index(int $id)
    {
        $posts = $this->post->getAllPostsByUserId($id);

        return view('user.list.index')
        ->with('posts',$posts);
    }

    public function create()
    {

        $categories = $this->category->getAllCategories();

        return view('user.list.create')
        ->with('categories',$categories);
    }

    //新規記事投稿機能
    public function store(PostRequest $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        switch (true) {
            case $request->has('save_draft'):
                $this->post->insertPostToSaveDraft($user_id,$request);
                break;
            case $request->has('release'):
                $this->post->insertPostToSaveRelease($user_id,$request);
                break;
            case $request->has('reservation_release'):
                $this->post->insertPostToSaveReservationRelease($user_id,$request);
                break;
            default:
                $this->post->insertPostToSaveDraft($user_id,$request);
                break;
        }

        return  to_route('user.index',['id' => $user_id]);
    }
    //記事詳細画面
    public function show($post_id)
    {
        $showPostData = $this->post->feachPostDateByPostId($post_id);

        return view('user.list.show')
        ->with('showPostData',$showPostData);
    }

    public function edit($post_id)
    {

        $categories = $this->category->getAllCategories();
        $posts = $this->post->feachPostDateByPostId($post_id);

        return view('user.list.edit')
        ->with('categories',$categories)
        ->with('posts',$posts);
    }

    public function update(PostRequest $request,$post_id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $post = $this->post->feachPostDateByPostId($post_id);

        //$request,$postの順番でリクエストを飛ばさないとエラーになる
        switch (true) {
            case $request->has('save_draft'):
                $this->post->updatePostToSaveDraft($request,$post);
                break;
            case $request->has('release'):
                $this->post->updatePostToRelease($request,$post);
                break;
            case $request->has('reservation_release'):
                $this->post->updatePostToReservationRelease($request,$post);
                break;
            default:
                $this->post->updatePostToSaveDraft($request,$post);
                break;
        }

        return to_route('user.index',['id' => $user_id]);
    }

}