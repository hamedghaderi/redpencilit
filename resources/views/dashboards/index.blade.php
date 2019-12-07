@extends('layouts.dashboard')

@section('content')
    <div class="flex mb-12">
        <div class="w-full">
            <div class="p-6">
                <div class="bg-white shadow p-6 rounded mb-12">
                    @include('dashboards.info-form')
                </div>

                @can('edit-roles')
                    <div class="bg-white shadow p-6 rounded mb-12">
                    @include('dashboards.roles-form')
                </div>
                @endcan

                <div class="bg-white shadow p-6 rounded">
                    @include('dashboards.details-form')
                </div>
            </div>
        </div>
    </div>
@endsection






