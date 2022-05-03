@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Inici') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{ __('No hi ha cap recepta publicada') }}
        </div>
    </div>
@endsection