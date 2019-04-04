<nav class="dashboard-nav">
    <div class="dashboard-logo mb-8 pt-6 px-6 pb-3 text-right border-b border-grey-lighter">
        <img src="{{ asset('images/logo.svg') }}" alt="redpencilit" style="width:50px">
    </div>

    <ul class="dashboard-nav__list">
        <li>
            <a href="#" class="has-icon">
                <i class="far fa-newspaper pl-3"></i>
                مقالات آپلود شده
            </a>
        </li>

        <li>
            <a href="{{ '/dashboard/' . auth()->user()->username . '/general_settings' }}" class="has-icon">
                <i class="fas fa-cog pl-3"></i>
                تنظیمات کلی
            </a>
        </li>

        <li>
            <a href="{{ route('services', auth()->user()->username) }}" class="has-icon">
                <i class="fas fa-stream pl-3"></i>
                سرویس‌ها
            </a>
        </li>

        <li>
            <a href="{{ '/dashboard/' . auth()->user()->username }}" class="has-icon">
                <i class="far fa-user pl-3"></i>
                تنظیمات حساب کاربری
            </a>
        </li>

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
</nav>