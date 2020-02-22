@extends('layouts.dashboard')

@section('content')
    <ticket></ticket>

    <div class="flex px-8">
        <h4 class="mb-4 text-grey-dark">{{ __('list of all tickets') }}</h4>

        <div class="ml-auto">
            {{  $tickets->links() }}
        </div>
    </div>

    <ticket-list :collection="{{ json_encode($tickets->toArray()['data']) }}"></ticket-list>
@endsection
