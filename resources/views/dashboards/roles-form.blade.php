<form action="{{ route('admin.users.patch', [app()->getLocale(), $user]) }}" method="POST"
      class="w-full">
    @csrf
    @method('PATCH')

    <div class="flex items-center border-b border-grey-lighter pb-3 mb-3">
        <h3 class="text-base md:text-lg flex items-center text-grey-darker">
                                <span class="text-grey ml-1">
                                    <i class="la la-user-alt text-2xl"></i>
                                </span>
            نقش‌ها
        </h3>
    </div>

    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3 pb-6">
            <label for="name" class="text-grey-darker block mb-4">انتخاب نقش</label>

            <div class="flex w-full">
                @foreach ($roles as $role)
                    <div class="w-1/4 mb-4">
                        <input
                                type="checkbox"
                                id="role{{$role->id}}"
                                value="{{ $role->id }}"
                                name="roles[]"
                                @if ($user->roles->contains($role->id)) checked @endif>
                        <label class="text-sm text-grey-darker" for="role{{$role->id}}">
                            {{ $role->label }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <hr class="mb-3">

    <div class="row">
        <button @click="" class="button button--primary">ذخیره اطلاعات</button>
    </div>

</form>