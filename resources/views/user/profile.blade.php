@extends('layouts.app')

@section('title', $user->nick)

@section('content')
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-3">
                <img class="avatar" src="{{ route('image.getavatar', ['filename'=>Auth::user()->image]) }}">
                <h2>{{$user->nick}}</h2>
                <h3>{{$user->nom}}</h3>
            </div>
            <div class="col-md-3">
                @if($user->posts->isNotEmpty())
                    <div class="d-flex flex-wrap justify-content-around">
                        @foreach ($user->posts as $post)
                            <div class="card m-1" style="width: 30rem;">
                                <div class="card-header">
                                    <img src="{{ route('image.getavatar', ['filename'=>$post->user->image]) }}" class="avatar">
                                    <span class="inline-block">{{$post->user->name}} {{$post->user->surname}} </span><span style="color: grey; fonts-size: 5px;">|   {{ '@'.$post->user->nick }}</span>
                                </div>
                                    <img class="card-img-top" src="{{ route('image.getpostimg', ['filename'=>$post->image_path]) }}">
                                    <div class="card-body">
                                    @auth
                                        <img class="m-2 btn-like" style="width: 1.5em" src="{{ asset('/images/heart/heart-v.png') }}" data-id="{{$post->id}}">
                                        <img class="m-2 btn-favorite" style="width: 1.8em" src="{{ asset('/images/favorite/favorite-v.png') }}" data-id="{{$post->id}}">
                                    @endauth
                                    <h5 class="card-title">{{$post->titol}}</h5>
                                    <!--<p class="card-text">{{$post->description}}</p>-->
                                    <a href="{{ route('post.view', ['id'=>$post->id]) }}" class="btn btn-primary btn-custom">Veure recepta</a>
                                </div>
                            </div>
                        @endforeach
                        {{-- $userposts->links() --}}
                    </div>
                @else 
                    <div>
                        <h2>No s'han trobat receptes d'aquet usuari</h2>
                    </div>
                @endif   
            </div>
        </div>
    </div>
@endsection