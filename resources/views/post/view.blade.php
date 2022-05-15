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
                    <p class="fs-5">
                        {{$post->description}}
                    </p>
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