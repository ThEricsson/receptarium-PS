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
            <div class="col-md-3 text-center">
                <img class="avatar-user-detail mb-2" src="{{ route('image.getavatar', ['filename'=>$user->image]) }}">
                <h2>{{"@".$user->nick}}</h2>
                <h4 class="text-muted">{{$user->name." ".$user->surname}}</h4>
                <hr>
                <img class="my-2 ms-2 me-0 " style="width: 1.8em" src="{{ asset('/images/heart/heart.png') }}"> <span>{{$totalLikes}}</span>
                <img class="my-2 ms-2 me-0 " style="width: 1.7em" src="{{ asset('/images/favorite/favorite.png') }}"> <span>{{$totalFavs}}</span>
                @if ($user->id == Auth::user()->id)
                    <br>
                    <a class="btn btn-success" href="{{route('user.edit')}}">Editar perfil</a>
                @endif
            </div>
            <div class="col-md-9 border-start">
                @if($posts->isNotEmpty())
                <div id="masonry" class="grid">
                    @foreach ($posts as $post)
                        <div class="grid-item m-3">
                            <div style="width: 23em;" class="card custom-card post">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-11">
                                            <img src="{{ route('image.getavatar', ['filename'=>$post->user->image]) }}" class="avatar">
                                            <a style="color: black;" href="{{route('user.profile', ['id'=>$post->user->id])}}"><span class="inline-block">{{$post->user->name}} {{$post->user->surname}} </span></a><span style="color: grey; fonts-size: 5px;">|   <a style="color: grey; fonts-size: 5px;" href="{{route('user.profile', ['id'=>$post->user->id])}}">{{ '@'.$post->user->nick }}</a></span>    
                                        </div>
                                        <div class="col-1">
                                            @auth
                                                @if ($post->user_id == Auth::user()->id)
                                                    <a style="color: black;" class="dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                        <span class="material-icons">&#xe5d4;</span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                        <form method="POST" action="{{route('post.delete')}}">
                                                            @csrf
                                                            <input type="hidden" value="{{ $post->id }}" name="post_id">
                                                            <button style="color: red;" class="dropdown-item" type="submit">
                                                                {{_('Eliminar post')}}
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                                    <a href="{{ route('post.view', ['id'=>$post->id]) }}">
                                        <img class="card-img-top" src="{{ route('image.getpostimg', ['filename'=>$post->image_path]) }}">
                                    </a>
                                <div class="card-body d-flex justify-content-between">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h5 class="card-title mt-1">{{$post->titol}}</h5>
                                    </div>
                                    @auth
                                        <div>
                                            <?php $user_like = False; ?>
    
                                            @foreach ($post->likes as $like)
                                                @if ($like->post_id == $post->id and $like->user_id == Auth::user()->id)
                                                    <?php $user_like = True; ?>  
                                                @endif
                                            @endforeach
    
                                            @if($user_like)
                                                <img class="my-2 ms-2 me-0 btn-dislike" style="width: 1.5em;" src="{{ asset('/images/heart/heart.png') }}" data-id="{{$post->id}}">
                                            @else
                                                <img class="my-2 ms-2 me-0 btn-like" style="width: 1.5em;" src="{{ asset('/images/heart/heart-v.png') }}" data-id="{{$post->id}}">
                                            @endif
                                            <span>{{$post->likes->count()}}</span>
                                        
                                            <?php $user_favorite = False; ?>
    
                                            @foreach ($post->favorites as $favorite)
                                                @if ($favorite->post_id == $post->id and $favorite->user_id == Auth::user()->id)
                                                    <?php $user_favorite = True; ?>  
                                                @endif
                                            @endforeach
                                        
                                            @if($user_favorite)
                                                <img class="my-2 ms-2 me-0 btn-unfavorite" style="width: 1.4em" src="{{ asset('/images/favorite/favorite.png') }}" data-id="{{$post->id}}">
                                            @else
                                                <img class="my-2 ms-2 me-0 btn-favorite" style="width: 1.4em" src="{{ asset('/images/favorite/favorite-v.png') }}" data-id="{{$post->id}}">
                                            @endif
    
                                            <span>{{$post->favorites->count()}}</span>
                                        </div>
                                    @else
                                        <div>
                                            <img class="my-2 ms-2" style="width: 1.5em;" src="{{ asset('/images/heart/heart.png') }}">
                                            <span>{{$post->likes->count()}}</span>
                                            <img class="my-2 ms-2 me-0" style="width: 1.4em" src="{{ asset('/images/favorite/favorite.png') }}">
                                            <span>{{$post->favorites->count()}}</span>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">{{$posts->links('pagination::bootstrap-5')}}</div>
        @else 
            <div>
                <h2>No s'han trobat receptes</h2>
            </div>
        @endif   
            </div>
        </div>
    </div>
@endsection