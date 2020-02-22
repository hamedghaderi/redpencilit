
{{--@foreach($tickets as $ticket)--}}
{{--    <div class="bg-white p-8 mb-4 rounded shadow">--}}
{{--        <div class="flex">--}}
{{--            <h2 class="text-grey-darker text-lg">{{ $ticket->title }}</h2>--}}

{{--            @if ($ticket->attachment)--}}
{{--                <a class="text-grey-dark inline-flex items-center text-xs--}}
{{--                    @if (app()->getLocale() == 'fa') mr-auto @else ml-auto @endif"--}}
{{--                    href="{{ route('ticket.attachment', ['locale' => app()->getLocale(), 'ticket' => $ticket->id]) }}"--}}
{{--                   download="{{ $ticket->attachment }}">--}}
{{--                        <i class="text-grey las la-file-download text-2xl"></i>--}}
{{--                        {{ __('download attachment') }}--}}
{{--                <a>--}}
{{--            @endif--}}
{{--        </div>--}}

{{--        <hr class="mb-1">--}}

{{--        <div class="text-grey-dark leading-loose">--}}
{{--            {{ $ticket->body }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endforeach--}}
