<div class="card mb-8">
    <h4 class="mb-4">{{ __('services section') }}</h4>

    <hr>

    <div class="flex -mx-3 mb-4">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="servicesTitle" class="mb-3">{{ __('title') }}</label>
            <input class="input" type="text" name="faServicesTitle" value="{{
                    $page->data['fa']['ServicesTitle'] ?? ''
                    }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="servicesBody" class="mb-3">{{ __('body text') }}</label>
            <textarea class="input" type="text" name="faServicesBody">{{ $page->data['fa']['ServicesBody']
                    ?? ''
                    }}</textarea>
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="firstServiceTitle" class="mb-3">{{ __('first service title') }}</label>
            <input class="input" type="text" name="faFirstServiceTitle" value="{{
                $page->data['fa']['FirstServiceTitle'] ?? '' }}">
        </div>
    </div>

    <div class="flex -mr-3 mb-4">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="firstServiceBody" class="mb-3">{{ __('first service body') }}</label>
            <textarea class="input" type="text" name="faFirstServiceBody">{{
                    $page->data['fa']['FirstServiceBody']
                     ?? ''
                }}</textarea>
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="secondServiceTitle" class="mb-3">{{ __('second service title') }}</label>
            <input class="input" type="text" name="faSecondServiceTitle" value="{{
                $page->data['fa']['SecondServiceTitle'] ?? '' }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="secondServiceBody" class="mb-3">{{ __('second service body') }}</label>
            <textarea class="input" type="text" name="faSecondServiceBody">{{
                    $page->data['fa']['SecondServiceBody'] ?? ''
                }}</textarea>
        </div>
    </div>

    <div class="flex -mr-3">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="thirdServiceTitle" class="mb-3">{{ __('third service title') }}</label>
            <input class="input" type="text" name="faThirdServiceTitle" value="{{
                $page->data['fa']['ThirdServiceTitle'] ?? '' }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="thirdServiceBody" class="mb-3">{{ __('third service body') }}</label>
            <textarea class="input" type="text" name="faThirdServiceBody">{{
                    $page->data['fa']['ThirdServiceBody'] ?? ''
                }}</textarea>
        </div>
    </div>

    <hr>

    <div class="flex -mx-3 mb-4">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="servicesTitle" class="mb-3">Title</label>
            <input class="input" type="text" name="enServicesTitle" value="{{
                    $page->data['en']['ServicesTitle'] ??
                     '' }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="servicesBody" class="mb-3">Body</label>
            <textarea class="input" type="text" name="enServicesBody">{{ $page->data['en']['ServicesBody']
                    ?? ''
                    }}</textarea>
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="firstServiceTitle" class="mb-3">First Service Title</label>
            <input class="input" type="text" name="enFirstServiceTitle" value="{{
                $page->data['en']['FirstServiceTitle'] ?? '' }}">
        </div>
    </div>

    <div class="flex -mr-3 mb-4">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="firstServiceBody" class="mb-3">First Service Body</label>
            <textarea class="input" type="text" name="enFirstServiceBody">{{
                    $page->data['en']['FirstServiceBody']
                     ?? ''
                }}</textarea>
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="secondServiceTitle" class="mb-3">Second Service Title</label>
            <input class="input" type="text" name="enSecondServiceTitle"
                   value="{{ $page->data['en']['SecondServiceTitle'] ?? '' }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="secondServiceBody" class="mb-3">Second Service Body</label>
            <textarea class="input" type="text" name="enSecondServiceBody">{{
                    $page->data['en']['SecondServiceBody'] ?? ''
                }}</textarea>
        </div>
    </div>

    <div class="flex -mr-3">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="thirdServiceTitle" class="mb-3">Third Service Title</label>
            <input class="input" type="text" name="enThirdServiceTitle" value="{{
                $page->data['en']['ThirdServiceTitle'] ?? '' }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="thirdServiceBody" class="mb-3">Third Service Body</label>
            <textarea class="input" type="text" name="enThirdServiceBody">{{
                    $page->data['en']['ThirdServiceBody'] ?? '' }}</textarea>
        </div>
    </div>
</div>
