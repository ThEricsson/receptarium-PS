@extends('layouts.app')

@section('title','Editar post')

@section('content')

    <div class="card-body">
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('post.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <label for="titol" class="col-md-4 col-form-label text-md-end">{{ __('Títol de la recepta') }}</label>

                <div class="col-md-6">
                    <input id="titol" type="text" class="form-control @error('titol') is-invalid @enderror" name="titol" value="{{ $post->titol }}" required autocomplete="titol" autofocus>

                    @error('titol')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Descripció recepta') }}</label>

                <div class="col-md-6">
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"  rows="6" required autocomplete="description">{{ $post->description }}</textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="dificultat" class="col-md-4 col-form-label text-md-end">{{ __('Dificultat recepta') }}</label>

                <div class="col-md-6">
                        <select class="form-select" name="dificultat" @error('dificultat') is-invalid @enderror" value="{{ $post->dificultat }}" autocomplete="dificultat" required>
                            <option value="facil">Fàcil</option>
                            <option value="normal">Normal</option>
                            <option value="dificil">Difícil</option>
                        </select>

                    @error('dificultat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="tipus" class="col-md-4 col-form-label text-md-end">{{ __('Tipus de plat') }}</label>

                <div class="col-md-6">

                    <select class="form-select" name="tipus" @error('tipus') is-invalid @enderror" value="{{ $post->tipus }}" autocomplete="tipus" required>
                        <option value="entrant">Entrant</option>
                        <option value="principal">Plat principal</option>
                        <option value="postre">Postre</option>
                    </select>

                    @error('tipus')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            @php
                $index = 1;
                $ingredients_ids = [];
            @endphp

            <div class="row mb-3">
                <label for="ingredients" class="col-md-4 col-form-label text-md-end">{{ __('Ingredients de la recepta') }}</label>

                <div class="col-md-6">
                    @foreach ($post->ingredients as $ingredient)
                        <div class="p-1 input-group">
                            
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{$index}}</span>
                                </div>
                            <input type="text" class="form-control @error('ingredients') is-invalid @enderror" value="{{ $ingredient->content }}" name="ingredients[]" required>
                            

                            @error('ingredients')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @php
                            array_push($ingredients_ids, $ingredient->id);
                            $index += 1;
                        @endphp
                    @endforeach
                </div>
                
            </div>
            @php
                $index = 1;
                $passos_ids = [];
            @endphp
            <div class="row mb-3">
                <label for="passos" class="col-md-4 col-form-label text-md-end">{{ __('Passos de la recepta') }}</label>
                
                <div class="col-md-6">
                    @foreach ($post->passos as $pas)
                        <div class="p-1 input-group">
                            
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{$index}}</span>
                                </div>
                                <input type="text" class="form-control @error('passos') is-invalid @enderror" value="{{ $pas->content }}" name="passos[]" required>
                            

                            @error('titol')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @php
                            array_push($passos_ids, $pas->id);
                            $index += 1;
                        @endphp
                    @endforeach
                </div>
            </div>

            <div class="row mb-3">
                <label for="fotos" class="col-md-4 col-form-label text-md-end">{{ __('Fotografies de la recepta') }}</label>

                <div class="col-md-6">
                    <input id="fotos" type="file" class="form-control @error('fotos') is-invalid @enderror" name="fotos" autocomplete="fotos">

                    @error('fotos')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                    <label for="fotos" class="col-md-4 col-form-label text-md-end">{{ __('Fotografia actual') }}</label>

                <div class="col-md-6">
                    <img class="showavatar" src="{{ route('image.getpostimg', ['filename'=>$post->image_path]) }}">
                </div>
            </div>

            <input type="hidden" value="{{ $post->id }}" name="post_id">
            <input type="hidden" value="{{ json_encode($ingredients_ids) }}" name="ingredients_ids">
            <input type="hidden" value="{{ json_encode($passos_ids) }}" name="passos_ids">
            
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary btn-custom">
                        {{ __('Editar') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
    
@endsection
