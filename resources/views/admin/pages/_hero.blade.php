<div class="card mb-8">
    <h4 class="mb-4">{{ __('hero section') }}</h4>

    <hr>

    <div class="flex -mx-3">
        <div class="md:w-1/3 mx-3">
            <label class="label mb-3" for="homeHeroTitle">{{ __('title') }}</label>
            <input
                    class="input"
                    type="text"
                    name="faHomeHeroTitle"
                    value="{{ $page->data['fa']['HomeHeroTitle'] ?? '' }}"
            >
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="homeHeroBody" class="mb-3">{{ __('body text') }}</label>
            <textarea class="input" type="text" name="faHomeHeroBody">{{ $page->data['fa']['HomeHeroBody'] ?? ''
                    }}</textarea>
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="homeHeroButton" class="mb-3">{{ __('button text') }}</label>
            <input class="input" type="text" name="faHomeHeroButton" value="{{
                    $page->data['fa']['HomeHeroButton'] ?? '' }}">
        </div>
    </div>

    <hr>

    <div class="flex -mx-3">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="homeHeroTitle" class="mb-3">Title</label>
            <input class="input" type="text" name="enHomeHeroTitle" value="{{
                    $page->data['en']['HomeHeroTitle']
                    ?? ''
                    }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="homeHeroBody" class="mb-3">Body Text</label>
            <textarea class="input" type="text" name="enHomeHeroBody">{{ $page->data['en']['HomeHeroBody']
                    ?? ''
                    }}</textarea>
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="homeHeroButton" class="mb-3">Button Text</label>
            <input class="input" type="text" name="enHomeHeroButton" value="{{
                    $page->data['en']['HomeHeroButton'] ?? ''
                    }}">
        </div>
    </div>
</div>
