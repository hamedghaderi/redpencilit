<notifications></notifications>

{{--<dropdown classes="z-60 @if (app()->getLocale() === 'fa') mr-auto @else ml-auto @endif">--}}
{{--    <template v-slot:toggler>--}}
{{--        <span class="relative cursor-pointer @if (app()->getLocale() === 'fa') mr-auto @else ml-auto @endif">--}}
{{--            <i class="las la-bell text-2xl text-grey"></i>--}}

{{--            <span class="absolute pin-l pin-t bg-pink text-white rounded-full w-4 h-4 flex items-center justify-center"--}}
{{--                  style="font-size:9px; @if (app()->getLocale() === 'fa') transform: translate(-30%, -30%); @else--}}
{{--                          transform: translate(70%, -30%); @endif">--}}
{{--                {{ auth()->user()->unread_notifications_count  }}--}}
{{--            </span>--}}
{{--       </span>--}}
{{--    </template>--}}


{{--    <ul class="bg-white text-grey-dark px-2 py-8 block text-xs relative">--}}
{{--        @forelse(auth()->user()->unreadNotifications as $notification)--}}
{{--            <li>--}}
{{--                <a href="{{ $notification->data['link'] }}">--}}
{{--                    {{ $notification->data['message'][app()->getLocale()] }}--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        @empty--}}
{{--            <li>{{__("You don't have any notifications at this time.") }}</li>--}}
{{--        @endforelse--}}
{{--    </ul>--}}
{{--</dropdown>--}}
