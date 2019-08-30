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
                <li><a href="/about">درباره</a></li>
                <li><a href="/contact">تماس با ما</a></li>
                <li><a href="#">خدمات</a></li>
                <li>
                    <a class="{{ request()->route()->getName() === 'new-order' ? 'active' : ''  }}"
                       href="{{ route ('new-order') }}">
                        سفارش جدید
                    </a>
                </li>
                @if (auth()->check())
                    <li><a href="{{ '/users/' . auth()->user()->username . '/orders' }}">لیست سفارشات</a></li>
                @endif
            </ul>

            <!-- Left Side Of Navbar -->
            <div class="mr-auto">
                <nav-dropdown></nav-dropdown>
            </div>
        </div>
    </div>
</nav>
