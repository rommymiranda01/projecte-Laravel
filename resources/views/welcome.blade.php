@extends('layouts.app')
@section('content')
    @if(Auth::guest())
        <div class="container">
            <div class="headerFix slide header d-none d-sm-block">
                {{--    <img src="{{ asset('img/Escape-Room-Banner.jpg') }}" alt="banner">--}}
                <h1>Escape Room</h1>
            </div>
        </div>
    @endif
@endsection
