<div class="card mb-8">
    <h4 class="mb-4">{{ __('testimonial') }}</h4>

    <hr>

    <div class="flex flex-wrap -mx-3">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="testimonial" class="mb-3">{{ __('title') }}</label>
            <input class="input" type="text" name="faTestimonial" value="{{ $page->data['fa']['Testimonial']
                    ?? ''
                }}">
        </div>
    </div>

    <hr>

    <div class="flex flex-wrap -mx-3">
        <div class="md:w-1/3 mx-3">
            <label class="label" for="testimonial" class="mb-3">Title</label>
            <input class="input" type="text" name="enTestimonial" value="{{ $page->data['en']['Testimonial']
                    ?? ''
                }}">
        </div>
    </div>
</div>
