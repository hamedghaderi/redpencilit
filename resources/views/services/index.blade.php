@extends('layouts.dashboard')

@section('content')
    <services :user="{{ auth()->user() }}" :all-services="{{$services}}"></services>
@endsection





