<nav class="fixed z-50 pin-b pin-r md:pin-r md:pin-t bg-white w-full md:w-64 border-t border-grey-light md:border-t-none
md:border-l">
    <div class="hidden md:block dashboard-logo mb-8 pt-6 px-6 pb-3 text-right border-b border-grey-lighter">
        <img src="{{ asset('images/logo.svg') }}" alt="redpencilit" style="width:50px">
    </div>

    <ul class="flex md:block px-4 py-4 z-50 justify-between list-reset">
        @can('manage-all')
            <li class="md:mb-3">
                <dropdown classes="dropdown-top md-left">
                    <template v-slot:toggler>
                        <a href="#" class="text-grey-dark md:flex md:py-2 md:hover:bg-indigo-lightest
                        hover:text-indigo-dark md:rounded md:px-3 mb-1">
                            <svg class="fill-current h-5 w-5 md:ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24
                             24"
                                 width="24"
                                 height="24"><path class="heroicon-ui" d="M8 7V5c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h4a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9c0-1.1.9-2 2-2h4zm8 2H8v10h8V9zm2 0v10h2V9h-2zM6 9H4v10h2V9zm4-2h4V5h-4v2z"/></svg>

                            <span class="hidden md:block">مدیریت</span>

                            <svg class="fill-current h-5 w-5 mr-auto hidden md:inline-block" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 24
                             24"
                                 width="24"
                                 height="24"><path class="heroicon-ui" d="M14.7 15.3a1 1 0 0 1-1.4 1.4l-4-4a1 1 0 0 1 0-1.4l4-4a1 1 0 0 1 1.4 1.4L11.42 12l3.3 3.3z"/></svg>
                        </a>
                    </template>

                    <ul>
                        <li>
                            <a href="{{ '/settings' }}" class="flex items-center text-grey">
                                <svg class="fill-current w-5 h-5 ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0
                                 24 24" width="24"
                                      height="24"><path class="heroicon-ui" d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm14 8V5H5v6h14zm0 2H5v6h14v-6zM8 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 8a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg>
                                تنظیمات کلی
                            </a>
                        </li>

                        <li>
                            <a href="{{ '/dashboard/services' }}" class="flex items-center text-grey">
                                <svg class="fill-current h-5 w-5 ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0
                                0 24
                                24"
                                     width="24"
                                      height="24"><path class="heroicon-ui" d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>
                                <span>سرویس‌ها</span>
                            </a>
                        </li>

                        <li>
                            <a href="/users" class="flex items-center text-grey">
                                <svg class="fill-current h-5 w-5 ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0
                                 24 24" width="24"
                                      height="24"><path class="heroicon-ui" d="M9 12A5 5 0 1 1 9 2a5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h5a5 5 0 0 1 5 5v2zm-1.3-10.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/></svg>
                                کاربران
                            </a>
                        </li>

                        <li>
                            <a href="/comments" class="flex items-center text-grey">
                                <svg class="fill-current h-5 w-5 ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0
                                 24 24" width="24"
                                      height="24"><path class="heroicon-ui" d="M2 15V5c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v15a1 1 0 0 1-1.7.7L16.58 17H4a2 2 0 0 1-2-2zM20 5H4v10h13a1 1 0 0 1 .7.3l2.3 2.29V5z"/></svg>
                               نظرات کابران
                            </a>
                        </li>
                    </ul>
                </dropdown>
            </li>
        @endcan

        <li class="md:mb-3">
            <a href="{{ '/users/' . auth()->id() . '/orders' }}" class="text-grey-dark md:flex md:py-2
            md:hover:bg-indigo-lightest
                        hover:text-indigo-dark md:rounded md:px-3 md:mb-1">
                <svg class="fill-current w-5 h-5 md:ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     width="24"
                     height="24"><path
                            class="heroicon-ui" d="M6 2h9a1 1 0 0 1 .7.3l4 4a1 1 0 0 1 .3.7v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2zm9 2.41V7h2.59L15 4.41zM18 9h-3a2 2 0 0 1-2-2V4H6v16h12V9zm-2 7a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm0-4a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm-5-4a1 1 0 0 1-1 1H9a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1z"/></svg>

                <span class="hidden md:block">مقالات آپلود شده</span>
            </a>
        </li>

        <li class="md:mb-3">
            <a href="{{ '/dashboard/' . auth()->id() }}" class="text-grey-dark md:flex
            md:hover:bg-indigo-lightest
                        hover:text-indigo-dark md:rounded md:py-2 md:px-3 md:mb-1">
                <svg class="fill-current h-5 w-5 md:ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     width="24"
                     height="24"><path
                            class="heroicon-ui" d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z"/></svg>
                <span class="hidden md:block">تنظیمات حساب کاربری</span>
            </a>
        </li>

        @can('create-posts')
            <li class="md:mb-3">
                <a href="/posts/create" class="text-grey-dark md:flex md:hover:bg-indigo-lightest hover:text-indigo-dark
                 md:rounded md:py-2 md:px-3 md:mb-1">
                    <svg class="fill-current w-5 h-5 md:ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         width="24"
                         height="24"><path
                                class="heroicon-ui" d="M18 21H7a4 4 0 0 1-4-4V5c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2h2a2 2 0 0 1 2 2v11a3 3 0 0 1-3 3zm-3-3V5H5v12c0 1.1.9 2 2 2h8.17a3 3 0 0 1-.17-1zm-7-3h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 1 1 0-2zm9 11a1 1 0 0 0 2 0V7h-2v11z"/></svg>
                    <span class="hidden md:block">پست جدید</span>
                </a>
            </li>
        @endcan

        <li class="md:mb-6">
            <a href="#" class="text-grey-dark md:flex md:hover:bg-indigo-lightest hover:text-indigo-dark
                 md:rounded md:py-2 md:px-3 md:mb-1" onclick="event.preventDefault(); document.getElementById('logout-form')
            .submit
            ();">
                <svg class="fill-current w-5 h-5 md:ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     width="24"
                     height="24"><path
                            class="heroicon-ui" d="M19 6.41L8.7 16.71a1 1 0 1 1-1.4-1.42L17.58 5H14a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V6.41zM17 14a1 1 0 0 1 2 0v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2h5a1 1 0 0 1 0 2H5v12h12v-5z"/></svg>

                <span class="hidden md:block">خروج از حساب</span>

                <form id="logout-form" style="display: none;" action="/logout" method="POST">
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
        <a class="button button--outline--primary has-icon" href="{{ route('new-order') }}">
            <i class="far fa-file-alt pl-1"></i>
            سفارش جدید
        </a>
    </div>
</nav>