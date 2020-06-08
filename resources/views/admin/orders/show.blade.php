@extends('layouts.dashboard')

@section('content')
    <div class="md:pt-8 mb-12">
        <div>
            <div class="w-full">
                @include('admin.orders.receipt')
            </div>

            <div class="w-full">
                @include('admin.orders.details')
            </div>
        </div>
    </div>
@endsection
