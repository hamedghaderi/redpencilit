<div>
    <x-dropdown>
        @guest()
            <x-slot name="trigger">
                <button
                        class="border bg-white py-3 px-4 focus:outline-none rounded text-sm shadow hover:bg-red-500 hover:text-white"
                >
                    {{ __('profile') }}
                </button>
            </x-slot>
        @endguest

        @auth()
            <x-slot name="trigger">
                <div class="inline-flex justify-end items-center text-grey-darker cursor-pointer">
                    <span class="text-grey-darkest ml-2 text-sm">
                        {{ auth()->user()->name }}
                    </span>
                    <img src="{{ auth()->user()->avatar }}" class="w-8 h-8 rounded-full ml-1">
                    <i class="la la-angle-down"></i>
                </div>
            </x-slot>
        @endauth

        <x-slot name="content">
            <div>
                @guest()
                    <div>
                        <a href="{{ route('login') }}"
                           class="text-grey-dark block items-center py-2 px-3 mb-1 rounded hover:bg-blue-lightest hover:text-blue-dark">
                        <span class="flex items-center">
                            <i class="las la-sign-in-alt text-2xl"></i>
                            <span>
                                {{ __('login') }}
                            </span>
                        </span>
                        </a>

                        <a :href="registerUrl"
                           class="text-grey-dark block items-center py-2 px-3 mb-1 rounded hover:bg-green-lightest hover:text-green-dark">
                         <span class="flex items-center">
                             <i class="las la-user-plus text-2xl"></i>

                            <span>
                                {{ __('register') }}
                            </span>
                        </span>
                        </a>
                    </div>
                @endguest

                @auth()
                    <div>
                        <a class="border-b border-grey-lighter block py-4 mb-4 text-indigo flex items-center"
                           :href="dashboard">
                            <i class="la la-tachometer-alt text-2xl"></i>

                            <span class="text-grey-dark" :class="[locale === 'fa' ? 'mr-1' : 'ml-1']">
                        {{ __('dashboard') }}
                    </span>
                        </a>

                        <a class="block pb-4 text-red flex items-center" href="#" @click="logout">
                            <i class="la la-sign-out-alt text-2xl"></i>

                            <span class="text-grey-dark" :class="[locale === 'fa' ? 'mr-2' : 'ml-2']">
                        {{ __('logout') }}
                        </span>

                            <form id="logout-form" :action="logoutUrl" method="POST" style="display:none;">
                            </form>
                        </a>
                    </div>
                @endauth
            </div>
        </x-slot>
    </x-dropdown>
</div>
