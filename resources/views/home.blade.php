@extends('layouts.app')

@section('title', 'Inici')

@section('content')
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="d-flex flex-wrap justify-content-around">
            @foreach ($posts as $post)
                <div class="card m-1" style="width: 30rem;">
                    <div class="card-header">
                        <img src="{{ route('image.getavatar', ['filename'=>$post->user->image]) }}" class="avatar">
                        <span class="inline-block">{{$post->user->name}} {{$post->user->surname}} </span><span style="color: grey; fonts-size: 5px;">|   {{ '@'.$post->user->nick }}</span>
                    </div>
                    <img class="card-img-top" src="{{ route('image.getpostimg', ['filename'=>$post->image_path]) }}">
                    <div class="card-body">
                    <h5 class="card-title">{{$post->titol}}</h5>
                    <p class="card-text">{{$post->description}}</p>
                    <a href="{{ route('post.view', ['id'=>$post->id]) }}" class="btn btn-primary btn-custom">Veure recepta</a>
                    </div>
                </div>
            @endforeach
        </div>
        {{$posts->links()}}
    </div>
@endsection