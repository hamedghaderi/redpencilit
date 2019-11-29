@extends('layouts.master')

@section('content')
<div class="container">
    <div class="flex">
       <div class="w-1/2">
           <h3 class="title">{{ __('About Us') }}</h3>

           <p class="text-grey-dark leading-loose text-sm">
               {{ __('Lorem') }}
           </p>
       </div>
        
        <div class="w-1/2">
            <img src="{{ asset('images/about.svg') }}" alt="about us">
        </div>
    </div>
</div>

@endsection