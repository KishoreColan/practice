@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Click to back Home - ') }}
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Back Home</a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You in About us page!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
