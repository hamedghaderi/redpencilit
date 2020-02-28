@extends('layouts.master')

@section('content')
    <upload-view :services="{{ $services }}" csrf="{{ csrf_token() }}"></upload-view>
@endsection
