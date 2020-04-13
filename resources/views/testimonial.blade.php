<section id="your-comments" class="z-10 bg-cover relative overflow-hidden px-8 md:px-24 md:flex"
         style="background-image: url({{ asset('images/coffee.svg.jpg') }}); min-height: 450px;">

    <img src="{{ asset('images/coffee-blur.jpg.svg') }}" alt="a white blur shape"
         class="w-1/2 absolute z-0 {{ app()->getLocale() === 'fa' ? 'cloud-right' : 'cloud-left' }}"
         style="top: -180px; transform:rotate(-15deg);">

    <div class="pt-24 relative z-10 md:mb-8">
        <h3 class="text-white md:text-grey-900 font-light pb-3 text-2xl"
            data-sal="slide-left"
            data-sal-duration="600"
            data-sal-delay="600">

            {{ $home ? $home->data[app()->getLocale()]['Testimonial'] : '' }}
            <span class="block mt-4 h-1 w-24 bg-red mb-8"
                  data-sal="slide-left"
                  data-sal-delay="1000"
                  data-sal-duration="600"></span>
        </h3>
    </div>

    <div class="@if (app()->getLocale() === 'fa') mr-auto @else ml-auto @endif w-full md:w-1/2 carousel flex
        flex-col md:justify-center"
         style="height: 500px;
        max-height:
        500px;
        overflow: hidden">
        @foreach($testimonials as $testimonial)
            <div class="bg-white hover:shadow-2xl rounded shadow-lg mb-4 px-8 py-4 carousel__item">
                <div class="flex border-b border-grey-lighter pb-4 mb-6 w-full">
                    <h4 class="text-grey-darkest">{{ $testimonial->comment->name }}</h4>
                    <span class="text-grey mr-auto text-sm">
                            {{ $testimonial->comment->created_at->diffForHumans() }}
                        </span>
                </div>

                <p class="text-sm text-grey-dark w-full mb-1">
                    <span class="text-indigo text-lg font-bold">"</span>
                    {{ $testimonial->body }}
                    <span class="text-indigo text-lg font-bold">"</span>
                </p>

                <div class="w-full">
                    <ul class="flex list-reset justify-end">
                        @for($i = 0; $i < 5; $i++)
                            <li class="text-yellow-dark mr-1">
                                <i class="fa-star {{ $testimonial->comment->rate > $i ? 'fas' : 'far' }}"></i>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</section>
