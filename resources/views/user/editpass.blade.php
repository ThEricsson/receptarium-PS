@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Canviar contrasenya') }}</div>

        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            @foreach ($errors->all() as $error)

                <p class="text-danger">{{ $error }}</p>

            @endforeach 

            <form method="POST" action="{{ route('user.updatepass')}}">
                @csrf

                <div class="row mb-3">
                    <label for="old_password" class="col-md-4 col-form-label text-md-end">{{ __('Contrasenya antiga') }}</label>

                    <div class="col-md-6">
                        <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password"  required>

                        @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="new_password" class="col-md-4 col-form-label text-md-end">{{ __('Nova contrasenya') }}</label>

                    <div class="col-md-6">
                        <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password"  required>

                        @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="confirm_new_password" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar nova contrasenya') }}</label>

                    <div class="col-md-6">
                        <input id="confirm_new_password" type="password" class="form-control @error('confirm_new_password') is-invalid @enderror" name="confirm_new_password"  required>

                        @error('confirm_new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Editar') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
