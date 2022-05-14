<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    private $post;

    public function __construct()
    {
        $this->post = new Post();
    }

    public function index(int $id)
    {
        $posts = $this->post->getAllPostsByUserId($id);

        return view('user.list.index')
        ->with('posts',$posts);
    }
}