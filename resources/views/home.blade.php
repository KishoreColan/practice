
{{-- @extends('layouts.app') --}}
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}

		    <a href="{{ url('/about') }}" class="text-sm text-gray-700 underline float-right">About us</a>
                    <div><b>Kishore</b></div>

               </div>
                <h1>Testing Changes</h1>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
   </div>
</div>
@endsection
