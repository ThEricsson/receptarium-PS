@extends('layouts.app')

@section('title', 'Receptes')

@section('content')
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
            <div class="mb-3 col-md-12 rounded border cercador-custom">
                <div class="container p-3 rounded">
                    <form method="GET" action="{{ route('home.search') }}">
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <input class="form-control" value="{{$cerca ?? ''}}" type="search" name="cerca" placeholder="Cerca una recepta!">
                            </div>
                            <div class="col-md-6 d-flex @auth justify-content-between @else justify-content-center @endauth">
                                <button type="submit" name="action" value="last" class="btn btn-success">Últimes publicacions <span class="material-icons align-middle ms-1">&#xe8b5;</span></button>
                                <button type="submit" name="action" value="better" class="btn btn-success mx-2">Millor valorades <span class="material-icons align-middle ms-1">&#xe87d;</span></button>
                                @auth
                                    <button type="submit" name="action" value="favs" class="btn btn-success">Favorits <span class="material-icons align-middle ms-1">&#xe743;</span></button>   
                                @endauth
                                {{--
                                <select class="form-select" aria-label="Default select example">
                                    <option value="1">Més recent</option>
                                    <option value="2">Més agradat</option>
                                    <option value="3">Els meus fav</option>
                                </select>
                                --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="row">
                                <label class="col-md-3 col-form-label text-md-start" for="dificultat">{{ __('Dificultat recepta') }}</label>
                                    <div class="col-md-8">
                                        <select class="form-select" name="dificultat">
                                            <option selected value="all">Totes</option>
                                            <option value="facil">Fàcil</option>
                                            <option value="normal">Normal</option>
                                            <option value="dificil">Difícil</option>
                                        </select>
                                    </div>
                                </div>        
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <label class="col-md-2 col-form-label text-md-start" for="tipus">{{ __('Plat') }}</label>
                                    <div class="col-md-8">
                                        <select class="form-select" name="tipus">
                                            <option selected value="all">Tots</option>
                                            <option value="entrant">Entrant</option>
                                            <option value="principal">Plat principal</option>
                                            <option value="postre">Postre</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>              
                </div>
            </div>
            @if($posts->isNotEmpty())
            <div id="masonry" class="grid">
                @foreach ($posts as $post)
                    <div class="grid-item m-3">
                        <div class="card custom-card post">
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
                                <div style="width: 75%;" class="d-flex align-items-center justify-content-center">
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
            <div class="text-center">
                <h2>No s'han trobat receptes :(</h2>
            </div>
        @endif        
    </div>
@endsection