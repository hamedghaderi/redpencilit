@extends('layouts.master')

@section('content')
    <upload-view></upload-view>

    <form action="/api/documents" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" multiple name="articles[]">
        <button type="submit">Submit</button>
    </form>
@endsection
