@extends('layout.layout')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 ">
                @foreach($posts as $post)
                   <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="https://via.placeholder.com/40" class="rounded-circle" alt="user" width="40" height="40">
                                <span class="ms-2">{{$post->user->name}}</span>
                            </div>
                        </div>
                        <img src="{{$post->image_url}}" class="card-img-top" alt="post-image">
                        <div class="card-body">
                            <p class="mt-2"><strong>{{$post->title}}: </strong>{{$post->content}}</p>
                            <p class="text-muted">5 хвилин тому</p>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </div>
@endsection
