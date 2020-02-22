<nav class="fixed z-50 pin-b
    @if (app()->getLocale() === 'fa') pin-r md:pin-r md:border-l @elsepin-l md:pin-l md:border-r @endif
        md:pin-t bg-white w-full md:w-64 border-t border-grey-light md:border-t-none">

    <div class="hidden md:flex dashboard-logo mb-8 pt-6 px-6 pb-3 w-full
            @if(app()->getLocale() === 'fa') text-right @else text-left @endif border-b border-grey-lighter">
        <a href="{{ route('home', app()->getLocale()) }}">
            <img src="{{ asset('images/logo-last.svg') }}" alt="redpencilit" style="width:50px">
        </a>

        @include('partials.notifications')
    </div>

    <ul class="flex md:block px-4 py-4 z-50 justify-between list-reset">
        @can('manage-all')
            <li class="md:mb-3">
                <dropdown classes="dropdown-top z-10 @if (app()->getLocale() === 'fa') md-left @else md-right @endif">
                    <template v-slot:toggler>
                        <a href="#" class="text-grey-dark md:flex items-center md:py-2 md:hover:bg-indigo-lightest
                        hover:text-indigo-dark md:rounded md:px-3 mb-1">
                            <i class="la la-briefcase text-2xl @if (app()->getLocale() === 'fa') ml-3 @else mr-3
                            @endif"></i>
                            <span class="hidden md:block">{{ __('Management') }}</span>
                            @if (app()->getLocale() === 'fa')
                                <i class="la la-angle-left text-normal mr-auto"></i>
                            @else
                                <i class="la la-angle-right text-normal ml-auto"></i>
                            @endif
                        </a>
                    </template>

                    <ul>
                        <li>
                            <a href="{{ route('settings.index', app()->getLocale()) }}"
                               class="flex items-center text-grey">
                                <i class="la la-screwdriver text-2xl @if (app()->getLocale() === 'fa') ml-3 @else
                                        mr-3 @endif"></i>
                                {{ __('General Settings') }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('services.index', app()->getLocale()) }}"
                               class="flex items-center text-grey">
                                <i class="la la-cog text-2xl @if (app()->getLocale() === 'fa') ml-3 @else
                                        mr-3 @endif"></i>
                                <span>{{ ucfirst(__('services')) }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.users.index', app()->getLocale()) }}" class="flex items-center
                            text-grey">
                                <i class="la la-users text-2xl @if (app()->getLocale() === 'fa') ml-3 @else
                                        mr-3 @endif"></i>
                                {{ ucfirst(__('users')) }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.users.comments', app()->getLocale()) }}" class="flex items-center
                            text-grey">
                                <i class="la la-comments text-2xl @if (app()->getLocale() === 'fa') ml-3 @else
                                        mr-3 @endif"></i>
                                {{ ucfirst(__('comments')) }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.pages.index', app()->getLocale()) }}" class="flex items-center
                            text-grey">
                                <i class="las la-file-alt text-2xl @if (app()->getLocale() === 'fa') ml-3 @else
                                        mr-3 @endif"></i>
                                {{ ucfirst(__('pages')) }}
                            </a>
                        </li>
                    </ul>
                </dropdown>
            </li>
        @endcan

        <li class="md:mb-3">
            <a href="{{ route('users.orders.index', [app()->getLocale(), auth()->user()]) }}" class="text-grey-dark
            md:flex md:py-2 md:hover:bg-indigo-lightest hover:text-indigo-dark md:rounded md:px-3 md:mb-1 items-center">
                <i class="la la-file-alt text-2xl
                    @if (app()->getLocale() === 'fa') ml-3 @else mr-3 @endif"></i>
                <span class="hidden md:block">{{ ucfirst(__('uploaded documents')) }}</span>
            </a>
        </li>

        <li class="md:mb-3">
            <a href="{{ route('dashboard', [app()->getLocale(), auth()->user()])  }}" class="text-grey-dark
            md:flex
            md:hover:bg-indigo-lightest
                        hover:text-indigo-dark md:rounded md:py-2 md:px-3 md:mb-1 items-center">
                <i class="la la-user-tie text-2xl
                    @if (app()->getLocale() === 'fa') ml-3 @else mr-3 @endif"></i>
                <span class="hidden md:block">
                    {{ ucfirst(__('account settings'))  }}
                </span>
            </a>
        </li>

        <li class="md:mb-3">
            <a href="{{ route('tickets.create', app()->getLocale()) }}" class="text-grey-dark md:flex
            md:hover:bg-indigo-lightest hover:text-indigo-dark md:rounded md:py-2 md:px-3 md:mb-1 items-center">
                <i class="las la-headset text-2xl
                    @if (app()->getLocale() === 'fa') ml-3 @else mr-3 @endif"></i>
                <span class="hidden md:block">
                    {{ ucfirst(__('support')) }}
                </span>
            </a>
        </li>

        @can('manage-posts')
            <li class="md:mb-3">
                <a href="{{ route('posts.create', app()->getLocale()) }}" class="text-grey-dark md:flex
                md:hover:bg-indigo-lightest
                hover:text-indigo-dark
                 md:rounded md:py-2 md:px-3 md:mb-1 items-center">
                    <i class="la la-newspaper text-2xl
                        @if (app()->getLocale() === 'fa') ml-3 @else mr-3 @endif"></i>
                    <span class="hidden md:block">
                        {{ ucfirst(__('new post')) }}
                    </span>
                </a>
            </li>
        @endcan

        <li class="md:mb-6">
            <a href="#" class="text-grey-dark md:flex md:hover:bg-indigo-lightest hover:text-indigo-dark
                 md:rounded md:py-2 md:px-3 md:mb-1 items-center" onclick="event.preventDefault(); document
                 .getElementById('logout-form')
            .submit
            ();">
                <i class="la la-sign-out-alt text-2xl
                    @if (app()->getLocale() === 'fa') ml-3 @else mr-3 @endif"></i>

                <span class="hidden md:block">{{ ucfirst(__('logout')) }}</span>

                <form id="logout-form" style="display: none;" action="{{ route('logout', app()->getLocale()) }}"
                      method="POST">
                    @csrf
                </form>
            </a>
        </li>
    </ul>

    <div class="hidden md:block dashboard-nav__user">
        <avatar
                user="{{ auth()->id() }}"
                image="{{ auth()->user()->avatar ?
                    '/' . auth()->user()->avatar :
                    asset('images/avatar.svg')
                }}"></avatar>

        <h3>{{ auth()->user()->username }}</h3>
        <span>{{ auth()->user()->email }}</span>
    </div>

    <div class="hidden md:block new-order text-center">
        <a class="button button--outline--primary has-icon" href="{{ route('new-order', app()->getLocale()) }}">
            <i class="la la-file-alt @if (app()->getLocale() === 'fa') pl-1 @else pr-1 @endif text-lg"></i>
            {{ __('new order') }}
        </a>
    </div>
</nav>
