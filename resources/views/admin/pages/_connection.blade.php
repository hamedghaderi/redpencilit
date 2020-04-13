<div class="card mb-8">
    <h4 class="mb-4">{{ __('contact section') }}</h4>

    <hr>

    <div class="flex -mx-3 mb-4">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="connectionTitle" class="mb-3">{{ __('title') }}</label>
            <input class="input" type="text" name="faConnectionTitle" value="{{
                    $page->data['fa']['ConnectionTitle'] ?? '' }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="homePhoneNumber" class="mb-3">{{ __('phone number') }}</label>
            <input class="input" type="text" name="faConnectionPhone" value="{{
                    $page->data['fa']['ConnectionPhone'] ?? '' }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="homeMobile" class="mb-3">{{ __('mobile number') }}</label>
            <input class="input" type="text" name="faConnectionMobile" value="{{
                    $page->data['fa']['ConnectionMobile']
                    ?? ''
                }}">
        </div>
    </div>

    <div class="flex -mx-3">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="faConnectionInsta" class="mb-3">{{ __('instagram') }}</label>
            <input class="input" type="text" name="faConnectionInsta" value="{{ $page->data['fa']
                    ['ConnectionInsta']
                    ?? ''
                }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="connectionWhatsApp" class="mb-3">{{ __('what\'s app') }}</label>
            <input class="input" type="text" name="faConnectionWhatsApp" value="{{
                    $page->data['fa']['ConnectionWhatsApp']
                ?? ''
                }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="connectionEmail" class="mb-3">{{ __('email') }}</label>
            <input class="input" type="text" name="faConnectionEmail" value="{{ $page->data['fa']
                    ['ConnectionEmail']
                    ?? ''
                }}">
        </div>
    </div>

    <hr>

    <div class="flex -mx-3 mb-4">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="connectionTitle" class="mb-3">Title</label>
            <input class="input" type="text" name="enConnectionTitle" value="{{
                    $page->data['en']['ConnectionTitle'] ?? '' }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="homePhoneNumber" class="mb-3">Phone Number</label>
            <input class="input" type="text" name="enConnectionPhone" value="{{
                    $page->data['en']['ConnectionPhone'] ?? ''
                }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="homeMobile" class="mb-3">Mobile Number</label>
            <input class="input" type="text" name="enConnectionMobile" value="{{
                    $page->data['en']['ConnectionMobile']
                    ?? ''
                }}">
        </div>
    </div>

    <div class="flex -mx-3">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="connectionInsta" class="mb-3">Instagram</label>
            <input class="input" type="text" name="enConnectionInsta" value="{{
                    $page->data['en']['ConnectionInsta']
                    ?? ''
                }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="connectionWhatsApp" class="mb-3">WhatsApp</label>
            <input class="input" type="text" name="enConnectionWhatsApp" value="{{
                    $page->data['en']['ConnectionWhatsApp'] ?? '' }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="connectionEmail" class="mb-3">Email</label>
            <input class="input" type="text" name="enConnectionEmail" value="{{
                    $page->data['en']['ConnectionEmail'] ?? '' }}">
        </div>
    </div>
</div>
