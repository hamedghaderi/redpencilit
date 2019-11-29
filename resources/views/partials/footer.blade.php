<footer class="footer pt-32">
    <div class="flex flex-wrap container mb-12">
        <div class="w-full md:w-1/2 mb-12 md:mb-0 mt-12 md:mt-0">
            <a href="/">
                <img class="w-12 md:w-auto" src="{{ asset('images/logo.svg') }}" alt="Redpecilit">
            </a>

            <ul class="list-reset flex text-sm">
                <li class="ml-6"><a class="text-grey" href="/about">درباره</a></li>
                <li class="ml-6"><a class="text-grey" href="/contact">تماس با ما</a></li>
                <li class="ml-6"><a class="text-grey" href="/services">خدمات</a></li>
                <li class="ml-6"><a class="text-grey" href="/orders/create">ثبت سفارش</a></li>
            </ul>
        </div>

        <div class="w-full md:w-1/3 mr-auto">
            {{--   Search Box     --}}
            <form action="/posts" method="GET" class="mb-3">
                <div class="relative">
                    <input type="text" class="input rounded-full focus:shadow-none" placeholder="جستجو در وبلاگ">

                    <button type="submit" class="w-10 h-10 bg-grey text-white rounded-full absolute pin-l ml-1
                    pin-t hover:shadow-lg" style="margin-top: .2rem">
                        <svg class="fill-current h-5 w-5 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                             width="24"
                             height="24"><path
                                    class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg>
                    </button>
                </div>
            </form>

            <div class="text-center md:text-left text-lg">
                <a href="#" class="text-grey"><i class="fab fa-facebook-square"></i></a>
                <a href="#" class="text-grey mr-2"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-grey mr-2"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>

    <p class="text-center text-grey-light text-xs pb-4 md:pb-0">تمام حقوق این سایت متعلق به Redpencilit می‌باشد.</p>
</footer>