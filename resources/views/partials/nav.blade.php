<nav class="navbar">
    <div class="container">
        <div class="flex items-center content-center">
            <h1 class="xl:ml-16">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.svg') }}" alt="redpencilit">
                </a>
            </h1>

            <ul class="navbar__nav">
                <li><a href="/">خانه</a></li>
                <li><a href="#">درباره</a></li>
                <li><a href="#">تماس با ما</a></li>
                <li><a href="#">خدمات</a></li>
                <li>
                    <a class="{{ request()->route()->getName() === 'new-order' ? 'active' : ''  }}"
                       href="{{ route ('new-order') }}">
                        سفارش جدید
                    </a>
                </li>
                <li><a href="#">لیست سفارشات</a></li>
            </ul>

            <!-- Left Side Of Navbar -->
            <div class="mr-auto">
                <dropdown classes="text-left">
                    <template v-slot:toggler>
                        @if (auth()->guest())
                            <button class="button button--outline button--outline--danger">
                                حساب کاربری
                            </button>
                        @else
                            <div class="inline-flex justify-end items-center text-grey-darker cursor-pointer">
                                <img
                                        src="{{  auth()->user()->avatar ?: asset('images/avatar.svg') }}"
                                        alt="{{ auth() ->user()->name . ' avatar' }}"
                                        class="w-8 ml-1"
                                >
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        @endif
                    </template>

                    <div class="dropdown__content dropdown__content--left">
                        @if (auth()->guest())
                            <a href="/login">
                                <i class="fas fa-sign-out-alt"></i>
                                ورود به حساب کاربری
                            </a>

                            <a href="/register">
                                <i class="fas fa-user-plus"></i>
                                ثبت‌نام
                            </a>
                        @else
                            <span class="dropdown__title">{{ auth()->user()->name }}</span>

                            <a href="/dashboard">
                                <i class="fas fa-tachometer-alt text-indigo"></i>
                                داشبورد
                            </a>

                            <a href="#" onclick="document.getElementById('logout-form').submit()">
                                <i class="fas fa-sign-out-alt text-red"></i>
                                خروج از حساب کاربری

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:
                                none;">
                                    @csrf
                                </form>
                            </a>
                        @endif
                    </div>
                </dropdown>
            </div>
        </div>
    </div>
</nav>
