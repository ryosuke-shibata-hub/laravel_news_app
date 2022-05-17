<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'category_name',
        'created_at',
        'updated_at',
    ];

    //postとのリレーション
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //カテゴリーの取得
    public function getAllCategories()
    {
        $result = $this->get();

        return $result;
    }
}