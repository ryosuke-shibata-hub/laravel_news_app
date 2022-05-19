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
                $request->session()->flash('saveDraft','記事を下書きで保存しました。');
                break;
            case $request->has('release'):
                $this->post->insertPostToSaveRelease($user_id,$request);
                $request->session()->flash('release','記事を投稿しました');
                break;
            case $request->has('reservation_release'):
                $this->post->insertPostToSaveReservationRelease($user_id,$request);
                $request->session()->flash('reservationRelease','記事を予約公開しました');
                break;
            default:
                $this->post->insertPostToSaveDraft($user_id,$request);
                $request->session()->flash('saveDraft','記事を下書きで保存しました。');
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
                $request->session()->flash('updateSaveDraft','記事を下書きで保存しました。');
                break;
            case $request->has('release'):
                $this->post->updatePostToRelease($request,$post);
                $request->session()->flash('updateRelease','記事を更新し公開しました。');
                break;
            case $request->has('reservation_release'):
                $this->post->updatePostToReservationRelease($request,$post);
                $request->session()->flash('updateReservationRelease','記事を下書きで保存しました。');
                break;
            default:
                $this->post->updatePostToSaveDraft($request,$post);
                $request->session()->flash('updateSaveDraft','記事を下書きで保存しました。');
                break;
        }

        return to_route('user.index',['id' => $user_id]);
    }

    public function saveDraft()
    {

        $user = Auth::user();
        $user_id = $user->id;

        $saveDraft = $this->post->getSaveDraft($user_id);

        return view('user.list.saveDraft')
        ->with('saveDraft',$saveDraft);
    }

    public function release()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $releases = $this->post->getReleasePost($user_id);

        return view('user.list.release')
        ->with('releases',$releases);
    }

    public function reservationRelease()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $reservationRelease = $this->post->getResaervationRelease($user_id);

        return view('user.list.reservationRelease')
        ->with('reservationRelease',$reservationRelease);
    }
}