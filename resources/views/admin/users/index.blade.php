@extends ('layouts.dashboard')

@section('content')

    <div class="flex mb-12">
        <div class="w-1/2">
            <div class="p-6">
                <h3 class="dashboard-title">{{ ucfirst(__('manage users')) }}</h3>

                <p class="dashboard-text">{{ ucfirst(__('in this section you can manage your users and give them a role.')) }}</p>
            </div>
        </div>
    </div>

    <hr>

    <div class="overflow-x-scroll xl:overflow-visible">
        <div style="min-width: 992px;">
            <div class="p-6 bg-white rounded shadow">
            <div class="flex items-center border-b border-grey-lighter pb-6">
                <h3 class="text-grey flex items-center">
                    <i class="la la-user text-2xl ml-1"></i>
                    <span class="text-grey-darker">{{ ucfirst(__('users list')) }}</span>
                </h3>

                <div class="w-1/3 @if (app()->getLocale() === 'fa') mr-auto @else ml-auto @endif">
                    <form method="GET" action="{{ route('admin.users.index', app()->getLocale()) }}" onchange="this.submit()"
                          class="flex
                w-full
                items-center">
                        <label for="type" name="type" class="label @if (app()->getLocale() === 'fa') ml-3 @else mr-3
                    @endif">{{ ucfirst(__('filter
                    by')) }}</label>
                        <div class="select flex-1">
                            <select name="type" id="type">
                                <option value="all" {{ request('type') === 'all' ? 'selected' : '' }}>
                                    {{ __('all') }}
                                </option>
                                <option value="coworkers" {{ request('type') === 'coworkers' ? 'selected' : ""}}>
                                    {{ __('co workers') }}
                                </option>
                                <option value="customers" {{ request('type') === 'customers' ? 'selected' : "" }}>
                                    {{ __('customers') }}
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
                                    <img class="w-8 h-8 rounded-full @if (app()->getLocale() === 'fa') ml-3 @else mr-3
                                @endif" src="{{ '/storage/' . $user->avatar }}"
                                         alt="avatar">
                                @else
                                    <div class="w-8 h-8 bg-blue-lightest rounded-full @if (app()->getLocale() === 'fa') ml-3 @else mr-3
                                @endif relative justify-center
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
                                        <span class="w-3 h-3 bg-yellow-dark inline-block @if (app()->getLocale() ===
                                    'fa') ml-2 @else mr-2
                                @endif rounded-full"></span>
                                    @endif

                                    <span class="text-xs text-yellow-darker">{{ $role->label }}</span>
                                </div>


                            @endforeach
                        </div>

                        <div class="w-1/4 flex @if (app()->getLocale() === 'fa') items-center @endif">
                            <a href="{{ route('dashboard', [app()->getLocale(), $user->id]) }}" class="button
                        button--smooth--success button--sm">
                                {{ __('edit') }}
                            </a>

                            {{--                        <inner-modal name="edit-role-{{$user->id}}">--}}
                            {{--                            <edit-role :user="{{$user}}" :roles="{{$roles}}"></edit-role>--}}
                            {{--                        </inner-modal>--}}

                            <form action="{{ route('admin.users.destroy', [app()->getLocale(), $user->id]) }}"
                                  method="post" class="@if (app()->getLocale() === 'fa') mr-auto @else ml-auto
                                @endif">
                                @csrf
                                @method('DELETE')

                                <button type="sumbit" class="button button--sm button--smooth--danger">
                                    {{ __('delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </div>



    {{ $users->links('vendor.pagination.paginator') }}
    </div>  <!-- .p-6 -->


@endsection

