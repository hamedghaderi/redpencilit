@extends('layouts.dashboard')

@section('content')
    <div class="flex mb-12">
        <div class="w-1/2">
            <div class="p-6">
                <h3 class="dashboard-title">ایجاد سرویس جدید</h3>

                <p class="dashboard-text">این گونه سرویس‌ها روی نحوه‌ی محاسبه‌ی هزینه تاثیر می‌گذارند. مثلا کاربری که
                    سرویس کتاب را
                    انتخاب
                    کند، قیمت نهایی و زمان، دیگر بستگی به تعداد کلمات ندارد و به صورت توافقی مشخص خواهد شد.</p>
            </div>
        </div>

        <div class="w-1/2">
            <div class="p-6">
                <div class="bg-white shadow p-6 rounded">
                    <form action="{{ '/dashboard/' .auth()->user()->name . '/services' }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="dashboard-label">نام سرویس جدید</label>
                            <input class="dashboard-input" type="text" name="name" id="name">
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="button button--sm button--outline--primary">ذخیره سرویس</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="px-6">
        <h3 class="dashboard-title mb-8">سرویس‌های موجود</h3>

        <div class="row px-6 mb-2 flex">
            <div class="w-1/4 text-sm text-grey-dark">
                نام سرویس
            </div>
            <div class="w-1/4 text-sm text-grey-dark">
                تاریخ ایجاد سرویس
            </div>

            <div class="w-1/4 text-sm text-grey-dark">
                تاریخ به روز رسانی
            </div>
        </div>

        @foreach($services as $service)
            <div class="row mb-3">
                <div class="bg-white px-6 py-3 shadow flex items-center relative">
                    <div class="w-1/4">
                        <form action="{{ '/dashboard/' . auth()->user()->name . '/services/' . $service->id }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <input type="text" name="name" value="{{ $service->name }}" class="focusable-input">
                        </form>
                    </div>

                    <div class="w-1/4 text-grey-darker">
                        {{ $service->created_at->diffForHumans() }}
                    </div>

                    <div class="w-1/4 text-grey-darker">
                        {{ $service->updated_at->diffForHumans() }}
                    </div>

                    <div class="w-1/4">
                        <form action="{{ '/dashboard/' . auth()->user()->name . '/services/' . $service->id }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="button button--outline--danger button--sm">حذف سرویس</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection





