@extends('layouts.dashboard')

@section('content')
    <h2 class="mb-8">{{ ucwords(__('update home page content')) }}</h2>

    <form class="mb-8" method="POST" action="{{ route('admin.home.store', app()->getLocale()) }}">
        @csrf
        @method('PATCH')
        <div class="card mb-8">
            <h4 class="mb-4">{{ __('hero section') }}</h4>

            <div class="flex -mx-3">
                <div class="md:w-1/3 mx-3">
                    <label class="label" for="homeHeroTitle" class="mb-3">{{ __('title') }}</label>
                    <input class="input" type="text" name="faHomeHeroTitle" value="{{
                    $page->data['fa']['HomeHeroTitle']
                    ?? '' }}">
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

        <div class="card mb-8">
            <h4 class="mb-4">{{ __('services section') }}</h4>

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

        <div class="card mb-8">
            <h4 class="mb-4">{{ __('contact section') }}</h4>

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

        <div class="card mb-8">
            <h4 class="mb-4">{{ __('request section') }}</h4>

            <div class="flex -mx-3">
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

            <div class="flex -mx-3">
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

        <div class="card mb-8">
            <h4 class="mb-4">{{ __('testimonial') }}</h4>

            <div class="flex -mx-3">
                <div class="md:w-1/3 mx-3">
                    <label class="label" for="testimonial" class="mb-3">{{ __('title') }}</label>
                    <input class="input" type="text" name="faTestimonial" value="{{ $page->data['fa']['Testimonial']
                    ?? ''
                }}">
                </div>
            </div>

            <hr>

            <div class="flex -mx-3">
                <div class="md:w-1/3 mx-3">
                    <label class="label" for="testimonial" class="mb-3">Title</label>
                    <input class="input" type="text" name="enTestimonial" value="{{ $page->data['en']['Testimonial']
                    ?? ''
                }}">
                </div>
            </div>
        </div>

        <div class="card mb-8">
            <h4 class="mb-4">{{ __('team') }}</h4>

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

        <button class="button button--primary">{{ __('save') }}</button>
    </form>
@endsection