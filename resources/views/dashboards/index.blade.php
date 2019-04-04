@extends('layouts.dashboard')

@section('content')
    <div class="flex mb-12">
        <div class="w-full">
            <div class="p-6">
                <div class="bg-white shadow p-6 rounded">
                    <form action="{{ '/dashboard/' . auth()->user()->username }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <user-account-form
                                name="{{ auth()->user()->name }}"
                                email="{{ auth()->user()->email }}"
                                phone="{{ auth()->user()->phone }}"
                                username="{{ auth()->user()->username }}"
                                >
                        </user-account-form>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection






