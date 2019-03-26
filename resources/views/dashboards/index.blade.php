@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>خوش آمدید جناب {{ auth()->user()->name }}</h1>
    </div>
@endsection