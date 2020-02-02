<form action="{{ $user->details ?
                    route('details.update', [app()->getLocale(), $user]) :
                    route('details.store', app() ->getLocale()) }}"
      method="POST"
      class="w-full">
    @csrf

    @if ($user->details)
        @method('PATCH')
    @endif

    <div class="flex items-center border-b border-grey-lighter pb-3 mb-3">
        <h3 class="text-base md:text-lg flex items-center text-grey-darker">
            <span class="text-grey @if (app()->getLocale() === 'fa') ml-1 @else mr-1 @endif">
                <i class="la la-user-edit text-2xl"></i>
            </span>
            {{ ucfirst(__('complementary information')) }}
        </h3>
    </div>

    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-6">
            <label for="country" class="label">
                {{ ucfirst(__('country')) }}
            </label>

            <div class="select">
                <select name="country_id" id="country">
                    <option value="">{{ __('country name') }}</option>

                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}"
                                {{ ($user->details && $user->details->country_id == $country->id) ? 'selected' : '' }}>
                            {{ $country->name[app()->getLocale()] }}
                        </option>
                    @endforeach
                </select>

                <div class="select__icon">
                    <i class="la la-angle-down text-sm"></i>
                </div>
            </div>

            @if ($errors->has('country_id'))
                <div class="feedback feedback--invalid">
                    {{ $errors->first('country_id') }}
                </div>
            @endif
        </div>

        <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-6">
            <label for="college" class="label">
                {{ ucfirst(__('university')) }}
            </label>
            <input id="college"
                   class="input"
                   type="text"
                   value="{{ $user->details ? $user->details->college : '' }}"
                   name="college">

            @if ($errors->has('college'))
                <div class="feedback feedback--danger">
                    {{ $errors->first('college') }}
                </div>
            @endif
        </div>

        <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-6">
            <label for="field" class="label">
                {{ ucfirst(__('study field')) }}
            </label>

            <input id="field"
                    class="input"
                    type="text"
                    value="{{ $user->details ? $user->details->field : '' }}"
                    name="field">

            @if ($errors->has('field'))
                <div class="feedback feedback--invalid">
                    {{ $errors->first('field') }}
                </div>
            @endif
        </div>

        <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-6 md:mb-0">
            <label for="degree_id" class="label">
                {{ ucfirst(__('degree')) }}
            </label>

            <div class="select">
                <select name="degree_id" id="degree_id">
                    <option value="">{{ __('degree') }}</option>

                    @foreach ($degrees as $degree)
                        <option value="{{ $degree->id }}"
                                {{ ($user->details && $user->details->degree_id == $degree->id) ? 'selected' : '' }}>
                            {{ $degree->name[app()->getLocale()] }}
                        </option>
                    @endforeach
                </select>

                <div class="select__icon">
                    <i class="la la-angle-down text-sm"></i>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-ful lg:w-1/3 px-3 mb-6 md:mb-0">
            <label for="address" class="label">
                {{ ucfirst(__('gender')) }}
            </label>
            <div class="flex">
                <label>
                    <input type="radio"
                           name="gender"
                           id="address"
                           value="{{ \App\Redpencilit\Gender::FEMALE }}"
                            {{ ($user->details && (int) $user->details->gender ===
                            (int) \App\Redpencilit\Gender::FEMALE) ?
                            "checked" : ''}}> {{ __('female') }}

                </label>

                <label class="mr-4">
                    <input
                            type="radio"
                            name="gender"
                            id="address"
                            value="{{ \App\Redpencilit\Gender::MALE }}"
                            {{ ($user->details && (int)$user->details->gender === (int) \App\Redpencilit\Gender::MALE) ?
                            'checked' : ''}}> {{ __('male') }}

                </label>
            </div>

        </div>

        <div class="w-full sm:w-ful lg:w-1/3 px-3 mb-6 md:mb-0">
            <label for="address" class="label">
                {{ ucfirst(__('address')) }}
            </label>
            <input class="input"
                    type="text"
                    name="address"
                    id="address"
                    value="{{ $user->details ? $user->details->address : '' }}">
        </div>
    </div>

    <hr class="mb-3">

    <div class="row">
        <button class="button button--primary">
            {{ __('save information') }}
        </button>
    </div>
</form>