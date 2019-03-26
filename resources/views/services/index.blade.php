@extends('layouts.master')

@section('content')
    <div class="container">
        <form action="/services" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">نام سرویس</label>
                <input type="text" name="name" id="name">
            </div>

            <div class="form-group">
                <button type="submit" class="button button--primary">ذخیره سرویس</button>
            </div>
        </form>

        <hr>

        @foreach($services as $service)
            <div class="row">
                <div class="w-1/2">
                    {{ $service->name }}
                </div>

                <div class="w-1/2">
                    {{ $service->created_at->diffForHumans() }}
                </div>
            </div>
        @endforeach
    </div>
@endsection