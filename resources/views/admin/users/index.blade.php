@extends ('layouts.dashboard')

@section('content')

    <div class="flex mb-12">
        <div class="w-1/2">
            <div class="p-6">
                <h3 class="dashboard-title">مدیریت کاربران</h3>

                <p class="dashboard-text">در این قسمت شما می‌توانید کاربران خود را مدیریت کرده و به‌ آن‌ها نقش‌های
                    متفاوتی اعطا کنید.</p>
            </div>
        </div>
    </div>

    <hr>

    <div class="p-6 bg-white rounded shadow">
        <div class="flex items-center border-b border-grey-lighter pb-6">
            <h3 class="text-grey flex items-center">
                <i class="la la-user text-2xl ml-1"></i>
                <span class="text-grey-darker">لیست کاربران</span>
            </h3>

            <div class="w-1/3 mr-auto">
                <form method="GET" action="{{ route('admin.users.index', app()->getLocale()) }}" onchange="this.submit()"
                      class="flex
                w-full
                items-center">
                    <label for="type" name="type" class="label ml-3">فیلتر بر اساس</label>
                    <div class="select flex-1">
                        <select name="type" id="type">
                            <option value="all" {{ request('type') === 'all' ? 'selected' : '' }}>همه‌</option>
                            <option value="coworkers" {{ request('type') === 'coworkers' ? 'selected' : ""}}>همکاران
                            </option>
                            <option value="customers" {{ request('type') === 'customers' ? 'selected' : "" }}>مشتریان
                            </option>
                        </select>

                        <div class="select__icon">
                            <i class="la la-angle-down text-sm"></i>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @foreach ($users as $user)
            <div class="row mb-3 text-sm">
                <div class="px-6 py-3 flex items-center relative border-b border-grey-lighter">
                    <div class="w-1/4">
                        <div class="flex items-center">
                            @if ($user->avatar)
                                <img class="w-8 h-8 rounded-full ml-3" src="{{ $user->avatar }}" alt="avatar">
                            @else
                                <div class="w-8 h-8 bg-blue-lightest rounded-full ml-3 relative justify-center
                                align-center text-center">
                                    <span class="text-blue text-xl font-bold">{{ substr($user->name, 0, 2)
                                    }}</span>
                                </div>
                            @endif

                            {{ $user->name }}
                        </div>
                    </div>

                    <div class="w-1/4">{{ $user->email }}</div>

                    <div class="w-1/4">
                        @foreach ($user->roles as $role)
                            <div class="flex items-center">
                                @if (isset($role))
                                    <span class="w-3 h-3 bg-yellow-dark inline-block ml-2 rounded-full"></span>
                                @endif

                                <span class="text-xs text-yellow-darker">{{ $role->label }}</span>
                            </div>


                        @endforeach
                    </div>

                    <div class="w-1/4 flex items-center">
                        <a href="{{ route('dashboard', [app()->getLocale(), $user->id]) }}" class="button
                        button--smooth--success button--sm">ویرایش
                        </a>

{{--                        <inner-modal name="edit-role-{{$user->id}}">--}}
{{--                            <edit-role :user="{{$user}}" :roles="{{$roles}}"></edit-role>--}}
{{--                        </inner-modal>--}}

                        <form action="{{ route('admin.users.destroy', [app()->getLocale(), $user->id]) }}"
                              method="post" class="mr-auto">
                            @csrf
                            @method('DELETE')

                            <button type="sumbit" class="button button--sm button--smooth--danger">حذف</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $users->links('vendor.pagination.paginator') }}
    </div>  <!-- .p-6 -->


@endsection

