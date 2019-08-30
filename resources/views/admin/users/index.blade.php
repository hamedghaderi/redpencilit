@extends ('layouts.dashboard')

@section('content')

    <div class="flex mb-12">
        <div class="w-1/2">
            <div class="p-6">
                <h3 class="dashboard-title">مدیریت کاربران</h3>

                <p class="dashboard-text">در این قسمت شما می‌توانید کاربران خود را مدیریت کرده و به‌ آن‌ها نقش‌های
                    متفاوتی عطا کنید.</p>
            </div>
        </div>
    </div>

    <hr>

    <div class="p-6">
        <h3 class="dashboard-title mb-8">لیست کاربران</h3>
        <div class="row px-6 mb-2 flex">
            <div class="w-1/4 text-sm text-grey-dark">نام</div>
            <div class="w-1/4 text-sm text-grey-dark">ایمیل</div>
            <div class="w-1/4 text-sm text-grey-dark">نقش</div>
            <div class="w-1/4"></div>
        </div>

        @foreach ($users as $user)
            <div class="row mb-3 text-sm">
                <div class="bg-white px-6 py-3 shadow flex items-center relative">
                    <div class="w-1/4">{{ $user->name }}</div>

                    <div class="w-1/4">{{ $user->email }}</div>

                    <div class="w-1/4">
                        @foreach ($user->roles as $role)
                            {{ $role->label }}
                        @endforeach
                    </div>

                    <div class="w-1/4 flex items-center">
                        <a href="#edit-role-{{$user->id}}" class="button button--smooth--success button--sm">ویرایش
                            نقش</a>

                        <inner-modal name="edit-role-{{$user->id}}">
                            <edit-role :user="{{$user}}" :roles="{{$roles}}"></edit-role>
                        </inner-modal>

                        <form action="{{ '/users/' . $user->username }}" method="post" class="mr-auto">
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

