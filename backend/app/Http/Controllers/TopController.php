<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Post;
use App\Models\Category;
use App\Services\UserService;

class TopController extends Controller
{
    public function __construct()
    {
        $this->category = new Category();
        $this->post = new Post();
        $this->userService = new UserService();
    }

    //top画面
    public function top()
    {

        $categories = $this->category->getAllCategories();
        $posts = $this->post->getPostsSortByLatestUpdate();
        $user_id = $this->userService->loginUserId();

        return view('top')
        ->with('user_id',$user_id)
        ->with('categories',$categories)
        ->with('posts',$posts);
    }

    //top画面カテゴリーごとの表示
    public function articleCategory($category_id)
    {

        $categories = $this->category->getAllCategories();
        $posts = $this->post->getPostByCategoryId($category_id);
        $user_id = $this->userService->loginUserId();

        return view('article.category')
        ->with('user_id',$user_id)
        ->with('categories',$categories)
        ->with('posts',$posts);
    }

    //top記事詳細
    public function articleShow($post_id)
    {

        $categories = $this->category->getAllCategories();
        $post = $this->post->feachPostDateByPostId($post_id);
        $user_id = $this->userService->loginUserId();

        return view('article.show')
        ->with('user_id',$user_id)
        ->with('categories',$categories)
        ->with('post',$post);
    }
}
