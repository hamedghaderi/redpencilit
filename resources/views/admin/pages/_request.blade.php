<div class="card mb-8">
    <h4 class="mb-4">{{ __('request section') }}</h4>

    <hr>

    <div class="flex flex-wrap -mx-3">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="requestInsta" class="mb-3">{{ __('title') }}</label>
            <input class="input" type="text" name="faRequestTitle" value="{{
                    $page->data['fa']['RequestTitle']
                    ?? ''
                }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="requestBody" class="mb-3">{{ __('body text') }}</label>
            <textarea class="input" type="text" name="faRequestBody">{{ $page->data['fa']['RequestBody']
                    ?? ''
                }}</textarea>
        </div>
    </div>

    <hr>

    <div class="flex flex-wrap -mx-3">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="requestInsta" class="mb-3">Title</label>
            <input class="input" type="text" name="enRequestTitle" value="{{ $page->data['en']['RequestTitle']
                    ?? ''
                }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="requestBody" class="mb-3">Body</label>
            <textarea class="input" type="text" name="enRequestBody">{{ $page->data['en']['RequestBody']
                    ?? ''
                }}</textarea>
        </div>
    </div>
</div>
