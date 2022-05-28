<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;
use App\Models\ReservationPost;

class TrashController extends Controller
{
    private $post;
    private $category;
    private $reservationPost;

    public function __construct()
    {
        $this->post = new Post();
        $this->category = new Category();
        $this->reservationPost = new ReservationPost();
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

        $reservationPost = $this->reservationPost->getReservationPostByUserIdAndPostId($user_id, $post_id);
        if(isset($reservationPost)) {
            $this->reservationPost->deleteData($reservationPost);
        }

        $trash_posts = $this->post->moveTrashPostData($post);

        return to_route('user.index',['id' => $user_id])
        ->with('moveTrash','記事をゴミ箱に移しました');
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
        ->with('trash_posts',$trash_posts)
        ->with('restore','記事を復元しました');
    }

    public function delete($post_id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $trash_posts = $this->post->getTrashPostLists($user_id);

        $post = $this->post->feachPostDateByPostId($post_id);

        $reservationPost = $this->reservationPost->getReservationPostByUserIdAndPostId($user_id, $post_id);
        if(isset($reservationPost)) {
            $this->reservationPost->deleteData($reservationPost);
        }

        $deletePost = $this->post->deletePostData($post);

        return to_route('post.trash')
        ->with('user_id',$user_id)
        ->with('trash_posts',$trash_posts)
        ->with('delete','記事を完全に削除しました');
    }
}