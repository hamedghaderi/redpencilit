@extends('layouts.master')

@section('content')
<div class="container">
    <div class="flex flex-wrap">
       <div class="md:w-1/2 mb-4 md:mb-0">
           <h3 class="title">{{ ucwords(__('about')) }}</h3>

           <p class="text-grey-dark leading-loose text-sm mb-4">
               {{ __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores atque consequuntur culpa distinctio ex expedita explicabo fuga fugiat fugit maxime minima officiis quasi quibusdam quidem quis reiciendis sequi tempora, ullam!') }}
           </p>

           <p class="text-grey-dark leading-loose text-sm">
               {{ __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores atque consequuntur culpa distinctio ex expedita explicabo fuga fugiat fugit maxime minima officiis quasi quibusdam quidem quis reiciendis sequi tempora, ullam!') }}
           </p>
       </div>
        
        <div class="md:w-1/2">
            <img class="w-full" src="{{ asset('images/7.svg') }}" alt="about us">
        </div>
    </div>
</div>

@endsection