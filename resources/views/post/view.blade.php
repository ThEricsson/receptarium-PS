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
            <div style="width: auto" class="row">
                <div class="col-md-6 d-flex justify-content-center">
                    <p class="fs-5">
                        {{$post->description}}
                    </p>
                </div>
                <div class="col-md-6 d-flex justify-content-center" style="">
                    <img class="border border-dark rounded" style="width: 70%;" src="{{ route('image.getpostimg', ['filename'=>$post->image_path]) }}">
                </div>
            </div>
            <hr>
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