@extends('layouts.app')

@section('title', 'Publicar nova recepta')

@section('content')

    <div class="card-body">
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('post.upload')}}" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <label for="titol" class="col-md-4 col-form-label text-md-end">{{ __('Títol de la recepta') }}</label>

                <div class="col-md-6">
                    <input id="titol" type="text" class="form-control @error('titol') is-invalid @enderror" name="titol" value="{{ old('titol') }}" required autocomplete="titol" autofocus>

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
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" rows="6" required autocomplete="description"></textarea>

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
                        <select class="form-select" name="dificultat" @error('dificultat') is-invalid @enderror" value="{{ old('dificultat') }}" autocomplete="dificultat" required>
                            <option value="facil">Fàcil</option>
                            <option selected value="normal">Normal</option>
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

                    <select class="form-select" name="tipus" @error('tipus') is-invalid @enderror" value="{{ old('tipus') }}" autocomplete="tipus" required>
                        <option value="entrant">Entrant</option>
                        <option selected value="principal">Plat principal</option>
                        <option value="postre">Postre</option>
                    </select>

                    @error('tipus')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3" id="dynamicingredients">
                <label for="ingredients" class="col-md-4 col-form-label text-md-end">{{ __('Ingredients de la recepta') }}</label>

                <div class="col-md-6">
                    <div class="p-1 input-group" v-for="(ingredient, index) in ingredients" :key='index'>
                        <div class="input-group-prepend">
                            <span class="input-group-text">@{{index + 1}}</span>
                        </div>
                        <input type="text" class="form-control @error('ingredients') is-invalid @enderror" name="ingredients[]"
                        v-model="ingredient.ingName"
                        required
                        >
                        <span class="input-group-btn">
                            <button
                            type="button"
                            class="btn btn-danger"
                            v-on:click="remove(index)"
                            v-show="index != 0"
                        >Eliminar</button> 
                        </span>
                    </div>

                    <button
                        type="button"
                        class="mt-2 pb-0 btn btn-success"
                        v-on:click="addMore()"
                        :disabled="checkPas()"
                    > <span class="material-icons">&#xe145; &#xf1ea;</span></button>

                    @error('ingredients')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3" id="dynamicsteps">
                <label for="passos" class="col-md-4 col-form-label text-md-end">{{ __('Passos de la recepta') }}</label>

                <div class="col-md-6">
                    <div class="p-1 input-group" v-for="(pas, index) in passos" :key='index'>
                        <div class="input-group-prepend">
                            <span class="input-group-text">@{{index + 1}}</span>
                            </div>
                        <input type="text" class="form-control @error('titol') is-invalid @enderror" name="passos[]"
                        v-model="pas.paseName"
                        required
                        >
                        <span class="input-group-btn">
                            <button
                            type="button"
                            class="btn btn-danger"
                            v-on:click="remove(index)"
                            v-show="index != 0"
                        >Eliminar</button> 
                        </span>
                    </div>

                    <button
                        type="button"
                        class="mt-2 pb-0 btn btn-success"
                        v-on:click="addMore()"
                        :disabled="checkPas()"
                    > <span class="material-icons">&#xe145; &#xe22b;</span></button>

                    @error('passos')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="fotos" class="col-md-4 col-form-label text-md-end">{{ __('Fotografies de la recepta') }}</label>

                <div class="col-md-6">
                    <input id="fotos" type="file" class="form-control @error('fotos') is-invalid @enderror" name="fotos" value="{{ old('fotos') }}" autocomplete="fotos">

                    @error('fotos')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary btn-custom">
                        {{ __('Publicar recepta') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
