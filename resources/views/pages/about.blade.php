@extends('layouts.master')

@section('content')
<div class="container">
    <div class="flex flex-wrap">
       <div class="md:w-1/2 mb-4 md:mb-0">
           <h3 class="title">{{ ucwords(__('about us')) }}</h3>

           <p class="text-grey-dark leading-loose text-sm">
               {{ __('Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Asperiores atque consequuntur culpa distinctio ex
                                expedita explicabo fuga fugiat fugit maxime minima officiis quasi
                                quibusdam quidem quis reiciendis sequi tempora, ullam!') }}
           </p>
       </div>
        
        <div class="md:w-1/2">
            <img src="{{ asset('images/about.svg') }}" alt="about us">
        </div>
    </div>
</div>

@endsection