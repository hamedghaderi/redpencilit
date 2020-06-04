@extends('layouts.dashboard')

@section('content')
    <div class="p-8">
        <div class="flex -mx-8">
            <div class="p-4 w-2/5">
                @include('admin.orders.receipt')
            </div>

            <div class="w-3/5 p-4">
                @include('admin.orders.details')
            </div>
        </div>
    </div>

@endsection
