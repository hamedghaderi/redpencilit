@extends('layouts.master')

@section('content')
<div class="container">
    <div class="flex flex-wrap">
       <div class="md:w-1/2 mb-4 md:mb-0">
           <h3 class="title">{{ ucwords(__('about')) }}</h3>

           <div class="text-grey-dark leading-loose text-sm mb-4">
               {!! $about ? $about->data[app()->getLocale()]['Body'] : '' !!}
           </div>
       </div>

        <div class="md:w-1/2">
            <img class="w-full" src="{{ asset('images/7.svg') }}" alt="about us">
        </div>
    </div>
</div>

@endsection
