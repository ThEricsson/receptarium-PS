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
                <div class="card m-1" style="width: 25rem;">
                    <img class="card-img-top" src="{{ route('image.getpostimg', ['filename'=>$post->image_path]) }}">
                    <div class="card-body">
                    <h5 class="card-title">{{$post->titol}}</h5>
                    <p class="card-text">{{$post->description}}</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{$posts->links()}}
@endsection