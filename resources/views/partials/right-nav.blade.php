<nav class="dashboard-nav">
    <div class="dashboard-logo mb-8 pt-6 text-center">
        <img src="{{ asset('images/logo.svg') }}" alt="redpencilit">
    </div>

    <div class="dashboard-nav__user">
        <div
            class="dashboard-nav__avatar"
            style="background-image: url({{ asset('images/avatar.svg') }});">
        </div>

        <h3>{{ auth()->user()->name }}</h3>
        <span>کاربر عادی</span>
    </div>

    <ul class="dashboard-nav__list">
        <li>
            <a href="/dashboard/services" class="has-icon">
                <i class="fas fa-user-cog pl-3"></i>
                تنظیمات حساب کاربری
            </a>
        </li>

        <li>
            <a href="/dashboard/services" class="has-icon">
                <i class="fas fa-newspaper pl-3"></i>
                مقالات آپلود شده
            </a>
        </li>

        <li>
            <a href="/dashboard/services" class="has-icon">
                <i class="fas fa-stream pl-3"></i>
                سرویس‌ها
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

    <div class="dashboard-nav__back">
        <a href="/" class="has-icon">
            بازگشت به صفحه اصلی
            <i class="fas fa-long-arrow-alt-left pr-2"></i>
        </a>
    </div>
</nav>