@extends('layouts.master')

@section('content')
    <div class="container contact">
        <div class="flex items-center justify-center">
            <div class="w-1/3">

                <h3 class="title text-center">ارتباط با ما</h3>

                <p class="text-grey text-sm leading-loose mb-3">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                    از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>

                <form action="/contacts" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" placeholder="نام و نام خانوادگی" class="input input--rounded">
                    </div>

                    <div class="form-group">
                        <input type="email" placeholder="ایمیل" class="input input--rounded">
                    </div>

                    <div class="form-group">
                        <textarea name="message" id="message" class="textarea" placeholder="پیام"> </textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="button button--primary">ارسال</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection