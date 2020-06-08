@extends('layouts.dashboard')

@section('content')
    <div class="py-12">
        <h1 class="dashboard-title">آپلود مستندات</h1>
        <p class="dashboard-text w-1/2 leading-loose">ارسال فایل‌های نهایی برای کاربر. این فایل به
            محض
            آپلود از
            طریق
            ایمیل کاربر برای او ارسال می‌شود. همچنین در داشبورد او نیز قابل دانلود خواهد بود.
        </p>

        <hr>

        <div class="card mb-12">
            <form action="{{ route('admin.orders.reply.persist', [app()->getLocale(), $order]) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="mb-8">
                    <label for="attachments" class="label mb-4">فایل‌های ضمیمه</label>
                    <input type="file" name="attachments[]" multiple>

                    @error('attachments')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label for="mail-body" class="label mb-4">متن ایمیل</label>
                    <textarea class="textarea mb-2" name="mail-body" id="mail-body"></textarea>
                    <p class="text-sm text-grey-dark">این متن اختیاری است و همراه ایمیل ارسال خواهد
                        شد
                        .</p>
                    @error('mail-body')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-0 text-left">
                    <button class="button button--primary">ارسال</button>
                </div>
            </form>
        </div>

        <div class="card">
            @forelse($order->replies as $reply)
                <p class="mb-4">
                    <a href="{{ route('admin.orders.attachments', [app()->getLocale(), $reply]) }}"
                       class="flex items-center text-grey-dark hover:text-red">
                        <span class="flex items-center justify-center bg-red-lightest w-16 h-16
                        ml-4">
                            <i class="la la-file-download text-red text-3xl"></i>
                        </span>
                        {{ $reply->original_name }}
                    </a>
                </p>
            @empty
                <p>هنوز هیچ فایلی آپلود نشده است.</p>
            @endforelse
        </div>
    </div>
@endsection

