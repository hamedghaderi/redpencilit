<nav class="dashboard-nav">
    <div class="dashboard-logo mb-8 pt-6 px-6 pb-3 text-right border-b border-grey-lighter">
        <img src="{{ asset('images/logo.svg') }}" alt="redpencilit" style="width:50px">
    </div>

    <ul class="dashboard-nav__list">
        @can('manage-all')
            <li class="dashboard-nav__parent">
                <dropdown classes="dropdown-left">
                    <template v-slot:toggler>
                        <a href="#" class="has-icon">
                            <i class="fas fa-th-large pl-3"></i>
                            مدیریت

                            <i class="fas fa-caret-left mr-auto"></i>
                        </a>
                    </template>

                    <ul>
                        <li>
                            <a href="{{ '/settings' }}">
                                <i class="fa fa-list pl-3"></i>
                                تنظیمات کلی
                            </a>
                        </li>

                        <li>
                            <a href="{{ '/dashboard/' . auth()->user()->username . '/services' }}">
                                <i class="fas fa-cog pl-3"></i>
                                سرویس‌ها
                            </a>
                        </li>

                        <li>
                            <a href="/users">
                                <i class="fas fa-users pl-3"></i>
                                کاربران
                            </a>
                        </li>
                    </ul>
                </dropdown>
            </li>
        @endcan

        <li>
            <a href="{{ '/users/' . auth()->user()->username . '/orders' }}" class="has-icon">
                <i class="far fa-newspaper pl-3"></i>
                مقالات آپلود شده
            </a>
        </li>

        <li>
            <a href="{{ '/dashboard/' . auth()->user()->username }}" class="has-icon">
                <i class="far fa-user pl-3"></i>
                تنظیمات حساب کاربری
            </a>
        </li>

        @can('create-posts')
            <li>
                <a href="/posts/create" class="has-icon">
                    <i class="fas fa-blog pl-3"></i>
                    پست جدید
                </a>
            </li>
        @endcan

        <li>
            <a href="#" class="has-icon" onclick="event.preventDefault(); document.getElementById('logout-form').submit
            ();">
                <i class="fas fa-sign-out-alt pl-3"></i>
                خروج از حساب

                <form id="logout-form" style="display: none;" action="/logout" method="POST">
                    @csrf
                </form>
            </a>
        </li>
    </ul>

    <div class="dashboard-nav__user">
        <avatar
                user="{{ auth()->id() }}"
                image="{{ auth()->user()->avatar ?
                    '/' . auth()->user()->avatar :
                    asset('images/avatar.svg')
                }}"></avatar>

        <h3>{{ auth()->user()->username }}</h3>
        <span>{{ auth()->user()->email }}</span>
    </div>

    <div class="new-order text-center">
        <a class="button button--outline--primary has-icon" href="{{ route('new-order') }}">
            <i class="far fa-file-alt pl-1"></i>
            سفارش جدید
        </a>
    </div>
</nav>