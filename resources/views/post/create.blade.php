@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Publicar nova recepta') }}</div>

        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <form method="POST" action="{{ route('post.create')}}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label for="titol" class="col-md-4 col-form-label text-md-end">{{ __('Títol de la recepta') }}</label>

                    <div class="col-md-6">
                        <input id="titol" type="text" class="form-control @error('titol') is-invalid @enderror" name="titol"  required autocomplete="titol" autofocus>

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
                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="9" required autocomplete="description"></textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3" id="dynamicsteps">
                    <label for="passos" class="col-md-4 col-form-label text-md-end">{{ __('Passos de la recepta') }}</label>

                    <div class="col-md-6">
                        <div>
                            <input type="text" class="form-control @error('titol') is-invalid @enderror" name="passos"  
                            v-model="course.courseName"
                            placeholder="Introdueix el pas de la recepta"
                            required>

                            <button
                                type="button"
                                class="mt-2 btn btn-danger"
                                v-on:click="remove(index)"
                                v-show="index != 0"
                            >Eliminar</button>
                        </div>

                        <button
                            type="button"
                            class="mt-2 btn btn-success"
                            v-on:click="addMore()"
                        > Afegir pas</button>

                        @error('passos')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Publicar recepta') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection