<nav
    class="h-full max-h-full bg-white fixed top-0 flex flex-wrap w-72 border-gray-100 p-8 @if(app()->getLocale() === 'en') border-r-2 @else border-l-2 @endif">
    <div class="py-8">
        <x-logo/>
    </div>

    <ul class="w-full flex-shrink-0">
        <x-sidebar-link route="dashboard" icon="today" text="dashboard"/>
        <x-sidebar-link route="settings.index" icon="edit-fade" text="settings"/>
        <x-sidebar-link route="orders.index" icon="file-document" text="documents"/>
        <x-sidebar-link route="orders.index" icon="support" text="support"/>
        <x-sidebar-link route="posts.index" icon="website" text="blog"/>
    </ul>

    <footer class="bg-gray-100 rounded px-4 py-2 flex w-full items-center mt-auto">
        <x-dropdown placement="top">
            <x-slot name="trigger">
                <div class="flex items-center space-x-1 text-gray-400">
                    <img src="{{ asset('images/avatar.svg') }}" alt="{{ auth()->user()->name }}"
                         class="w-8 h-8 rounded-full">
                    <span><i @class('gg-chevron-down')></i></span>
                </div>
            </x-slot>

            <x-slot name="content">
                <ul class="py-4">
                    <li>
                        <a class="w-full inline-block hover:bg-gray-200 py-2 rounded-lg px-2 inline-flex items-center"
                           href="{{ route('dashboard.user.update') }}">
                            <x-icon icon="profile" size="16"
                                    class="text-gray-400 @if (app()->getLocale() === 'en') mr-2 @else ml-2 @endif"/>
                            {{ __('profile') }}
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button
                                class="w-full hover:bg-gray-200 p-2 rounded-lg inline-flex items-center @if(app()->getLocale() === 'en') text-left @else text-right @endif"
                                onclick="this.form.sumbit()"
                                href="{{ route('logout') }}">
                                <x-icon icon="log-out" size="16"
                                        class="relative top-0.5 text-gray-400 @if (app()->getLocale() === 'en') mr-2 @else ml-2 @endif"/>
                                {{ __('logout') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </x-slot>
        </x-dropdown>


        <div
            class="flex items-center text-gray-500 @if(app()->getLocale() === 'en') ml-auto @else mr-auto @endif">
            <a href="#" @class(app()->getLocale() === 'fa' ? 'ml-4' : 'mr-4')>
                <i class="gg-options"></i>
            </a>
            <a href="#" class="relative">
                <i class="gg-bell"></i>
                <span class="absolute top-0 -right-0.5 w-2 h-2 bg-red-500 rounded-full"></span>
            </a>
        </div>
    </footer>
</nav>
