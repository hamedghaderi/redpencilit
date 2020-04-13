<div class="slider mb-12">
    @foreach($services as $service)
        <div>
            <div class="bg-white shadow rounded p-8">
                <div class="text-center mb-8">
                    <img src="{{ asset('storage/' . $service->path) }}" class="h-32" alt="image">
                </div>

                <h2 class="text-grey-darkest text-xl mb-3 leading-normal">
                    {{ $service->title[app()->getLocale()] }}
                </h2>

                <p class="text-grey-dark leading-loose">
                    {{ $service->description[app()->getLocale()] }}</p>
            </div>
        </div>
    @endforeach
</div>
