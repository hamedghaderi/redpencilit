@extends('layouts.dashboard')

@section('content')
    <admin-ticket :ticketdata="{{ json_encode($ticket) }}"></admin-ticket>
{{--    <div class="p-6 bg-white rounded shadow">--}}
{{--        <div class="flex items-center border-b border-grey-light pb-4 mb-4">--}}
{{--            <h3 class="text-grey-darker">--}}
{{--                {{ $ticket->title }}--}}
{{--            </h3>--}}

{{--            <div class="text-grey-dark mr-auto text-xs flex flex-wrap items-center">--}}
{{--                <i class="las la-user-tie text-base text-grey"></i>--}}

{{--                {{ $ticket->owner->name }}--}}

{{--                <p class="text-grey-dark flex items-center mr-4">--}}
{{--                    <i class="las la-calendar text-base text-grey"></i>--}}
{{--                    {{ $ticket->created_at->diffForHumans() }}--}}
{{--                </p>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="text-grey-dark mb-8">--}}
{{--            {{ $ticket->body }}--}}
{{--        </div>--}}

{{--        <form action="{{ route('replies.store', [app()->getLocale(), $ticket->id]) }}" method="POST">--}}
{{--            @csrf--}}

{{--            <div class="mb-4">--}}
{{--                <textarea name="body" id="body" rows="10" class="input" placeholder="{{ __('Your reply...') }}"></textarea>--}}
{{--            </div>--}}

{{--            <button class="button button--primary">{{ __('Send Reply') }}</button>--}}
{{--        </form>--}}
{{--    </div>--}}
@endsection
