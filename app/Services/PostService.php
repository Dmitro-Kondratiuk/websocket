<?php

namespace App\Services;

use App\Data\PostCreateData;
use App\Data\PostsData;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelData\DataCollection;

class PostService
{
    public function create(PostCreateData $postCreateData): Model
    {
        $post = new Post();
        $post->title = $postCreateData->title;
        $post->content = $postCreateData->content;
        $post->image_url = $postCreateData->image_url;
        $post->morphable()->associate(Auth::user());
        $post->save();

        return $post;
    }
    public function show(): DataCollection
    {

        return PostsData::collect(Post::with('morphable')->get(), DataCollection::class);
    }
}
