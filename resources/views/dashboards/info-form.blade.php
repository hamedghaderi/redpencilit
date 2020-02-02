<form action="{{ route('dashboard.user.update', [app()->getLocale(), auth()->id()]) }}"
      method="POST"
      class="w-full">
    @csrf
    @method('PATCH')

    <div class="flex items-center border-b border-grey-lighter pb-3 mb-3">
        <h3 class="text-base md:text-lg flex items-center text-grey-darker">
            <span class="text-grey ml-1">
                <i class="la la-user-alt text-2xl"></i>
            </span>
            {{ ucfirst(__('account info')) }}
        </h3>
    </div>

    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 lg:w-1/3 px-3 pb-6">
            <label for="name" class="label">{{ ucfirst(__('full name')) }}</label>
            <input type="text" id="name" value="{{ $user->name }}" name="name" class="input">

            @if ($errors->has('name'))
                <div class="feedback feedback--invalid mt-1">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <div class="w-full md:w-1/2 lg:w-1/3 px-3 pb-6">
            <label for="email" class="label">{{ ucfirst(__('email address')) }}</label>
            <input id="email" class="input" type="email" name="email" value="{{ $user->email }}">

            @if ($errors->has('email'))
                <div class="feedback feedback--invalid mt-1">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <div class="w-full md:w-1/2 lg:w-1/3 px-3">
            <label for="mobile" class="label">{{ ucfirst(__('phone number')) }}</label>
            <input id="mobile" class="input" type="text" name="phone" value="{{ $user->phone }}">

            @if ($errors->has('phone'))
                <div class="feedback feedback--invalid mt-1">
                    {{ $errors->first('phone') }}
                </div>
            @endif
        </div>
    </div>

    <hr class="mb-3">

    <div class="row">
        <button @click="" class="button button--primary">{{ __('save information') }}</button>
    </div>
</form>
