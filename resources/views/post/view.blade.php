@extends('layouts.app')

@section('title', $post->titol)

@section('content')
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="justify-content-around">
            <div class="row">
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="row">
                        <div class="col-12" style="height: 3em">
                            <img src="{{ route('image.getavatar', ['filename'=>$post->user->image]) }}" class="avatar">
                            <a style="color: black;" href="{{route('user.profile', ['id'=>$post->user->id])}}"><span class="inline-block">{{$post->user->name}} {{$post->user->surname}} </span></a><span style="color: grey; fonts-size: 5px;">|   <a style="color: grey; fonts-size: 5px;" href="{{route('user.profile', ['id'=>$post->user->id])}}">{{ '@'.$post->user->nick }}</a></span>    
    
                        </div>
                        <div class="col-12">
                            <p class="fs-5">
                                {{$post->description}}
                            </p>
                        </div>
                        <div class="col-12">
                            @auth
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
                            @else
                                <img class="my-2 ms-2" style="width: 1.5em;" src="{{ asset('/images/heart/heart.png') }}">
                                <span>{{$post->likes->count()}}</span>
                                <img class="my-2 ms-2 me-0" style="width: 1.4em" src="{{ asset('/images/favorite/favorite.png') }}">
                                <span>{{$post->favorites->count()}}</span>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="col-md-8 d-flex justify-content-center" style="">
                    <img style="box-shadow: 0 6px 9px 0 rgba(30, 30, 26, 0.38);" class="rounded post-img" src="{{ route('image.getpostimg', ['filename'=>$post->image_path]) }}">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h3><span class="material-icons">&#xe80e;</span> Dificultat:</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-capitalize">{{$post->dificultat}}</li>
                        <li class="list-group-item"></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3><span class="material-icons">&#xea11;</span> Tipus:</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-capitalize">{{$post->tipus}}</li>
                        <li class="list-group-item"></li>
                    </ul>
                </div>
            </div>
            <div>
                <h3><span class="material-icons mt-2">&#xf1ea;</span> Ingredients:</h3>
                <ol class="list-group list-group-numbered">
                    @foreach($post->ingredients as $ingredient)
                        <li class="list-group-item list-group-item-action">{{ $ingredient->content }}</li>
                    @endforeach
                </ol>
            </div>
            <hr style="width: 15em">
            <div>
                <h3><span class="material-icons">&#xe22b;</span> Passos:</h3>
                <ol class="list-group list-group-numbered">
                    @foreach($post->passos as $pas)
                        <li class="list-group-item list-group-item-action">{{ $pas->content }}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('comments')

@auth
    <div class="m-3 col-md-8 card p-0">
        <form method="POST" action="{{ route('post.comentar') }}">
            @csrf
            <div class="card-header">
                <img src="{{ route('image.getavatar', ['filename'=>Auth::user()->image]) }}" class="avatar">
                <a style="color: black;" href="{{route('user.profile', ['id'=>Auth::user()->id])}}"><span class="inline-block">{{Auth::user()->name}} {{Auth::user()->surname}} </span></a><span style="color: grey; fonts-size: 5px;">|   <a style="color: grey; fonts-size: 5px;" href="{{route('user.profile', ['id'=>Auth::user()->id])}}">{{ '@'.Auth::user()->nick }}</a></span>    
            </div>
            <div class="card-body">
                <div class="row my-2">
                    <label for="comment" class="col-md-2 col-form-label text-md-end">{{ __('Comentari:') }}</label>
        
                    <div class="col-md-8">
                        <textarea id="comment" class="form-control @error('comment') is-invalid @enderror" name="comment" rows="6" required autocomplete="comment">{{ old('comment') }}</textarea>
        
                        @error('comment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-2 mt-3">
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <button type="submit" class="btn btn-primary btn-custom">
                                {{ __('Comentar!') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>    
    </div>
    @endauth
    @if ($post->comments)
        @foreach ($post->comments as $comment)
            <div class="m-3 col-md-8 card p-0">
                <div class="card-header">
                    <img src="{{ route('image.getavatar', ['filename'=>$comment->user->image]) }}" class="avatar">
                    <a style="color: black;" href="{{route('user.profile', ['id'=>$comment->user->id])}}"><span class="inline-block">{{$comment->user->name}} {{$comment->user->surname}} </span></a><span style="color: grey; fonts-size: 5px;">|   <a style="color: grey; fonts-size: 5px;" href="{{route('user.profile', ['id'=>$comment->user->id])}}">{{ '@'.$comment->user->nick }}</a></span>    
                </div>
                <div class="card-body">
                    <div class="row">            
                        <div class="col-md-8">
                            <p>{{$comment->content}}</p>
                        </div>
                    </div>
                </div> 
            </div>
        @endforeach
    @endif
@endsection
