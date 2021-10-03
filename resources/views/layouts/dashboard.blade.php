<x-layouts.base>
    {{--    @include('partials.right-nav')--}}
    <x-sidebar-nav></x-sidebar-nav>

    <main class="pt-6 @if (app()->getLocale() === 'fa') md:pr-64 @else md:pl-64 @endif">
        <div class="container">
            {{--            @yield('content')--}}
        </div>
    </main>
</x-layouts.base>
