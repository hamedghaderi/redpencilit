@extends('layouts.dashboard')

@section('content')
    <services :user="{{ auth()->user() }}"></services>
@endsection





