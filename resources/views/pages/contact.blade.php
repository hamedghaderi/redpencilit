@extends('layouts.master')

@section('content')
    <contact :page="{{ $contact ?? json_encode([]) }}"></contact>
@endsection
