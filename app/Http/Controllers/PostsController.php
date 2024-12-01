<?php

namespace App\Http\Controllers;

use App\Data\PostCreateData;
use App\Services\PostService;
use Illuminate\View\View;

class PostsController extends Controller
{
    public function __construct(private readonly PostService $postService)
    {
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(PostCreateData $postCreateData)
    {
        $this->postService->create($postCreateData);
        return redirect()->route('home')->with('success', 'Post created!');
    }
}
