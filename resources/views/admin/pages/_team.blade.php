<div class="card mb-8">
    <h4 class="mb-4">{{ __('team') }}</h4>

    <hr>

    <div class="flex -mx-3">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="teamJob" class="mb-3">{{ __('job title') }}</label>
            <input class="input" type="text" name="faTeamTitle" value="{{ $page->data['fa']['TeamTitle']
                    ?? ''
                }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="teamBody" class="mb-3">{{ __('body text') }}</label>
            <textarea class="input" type="text" name="faTeamBody">{{ $page->data['fa']['TeamBody'] ?? ''
                }}</textarea>
        </div>
    </div>

    <hr>

    <div class="flex -mx-3">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="teamJob" class="mb-3">Job Title</label>
            <input class="input" type="text" name="enTeamTitle" value="{{ $page->data['en']['TeamTitle']
                    ?? ''
                }}">
        </div>

        <div class="md:w-1/3 mx-3">
            <label class="label" for="teamBody" class="mb-3">Body</label>
            <textarea class="input" type="text" name="enTeamBody">{{ $page->data['en']['TeamBody'] ?? ''
                }}</textarea>
        </div>
    </div>
</div>
