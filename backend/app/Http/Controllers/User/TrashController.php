<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Post;
use App\Models\Category;

class TrashController extends Controller
{
    private $post;
    private $category;

    public function __construct()
    {
        $this->post = new Post();
        $this->category = new Category();
    }

    public function trashList()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $trash_posts = $this->post->getTrashPostLists($user_id);

        return view('user.list.trash')
        ->with('user_id',$user_id)
        ->with('trash_posts',$trash_posts);
    }

    public function moveTrash($post_id)
    {

        $user = Auth::user();
        $user_id = $user->id;
        $post = $this->post->feachPostDateByPostId($post_id);

        $trash_posts = $this->post->moveTrashPostData($post);

        return to_route('user.index',['id' => $user_id]);
    }

    public function restore($post_id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $trash_posts = $this->post->getTrashPostLists($user_id);
        $post = $this->post->feachPostDateByPostId($post_id);

        $restorePost = $this->post->restorePostData($post);

        return to_route('post.trash')
        ->with('user_id',$user_id)
        ->with('trash_posts',$trash_posts);
    }

    public function delete($post_id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $trash_posts = $this->post->getTrashPostLists($user_id);

        $post = $this->post->feachPostDateByPostId($post_id);

        $deletePost = $this->post->deletePostData($post);

        return to_route('post.trash')
        ->with('user_id',$user_id)
        ->with('trash_posts',$trash_posts);
    }
}