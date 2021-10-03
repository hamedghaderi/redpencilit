@props(['placement'])

<div {{ $attributes->merge(['class' => 'z-50 cursor-pointer ']) }} x-data="dropdown" x-cloak>
    <div tabindex="1"
         class="trigger"
         x-on:click="toggle"
         x-on:click.away="hide">
        {{ $trigger }}
    </div>

    <div
        x-show="open"
        class="tooltip absolute bg-white shadow-lg rounded w-64 py-2 px-4 text-sm">
        {{ $content }}
    </div>
</div>

@section('script')
    <script>
        console.log({{ $attributes->get('placement') }});
        const trigger = document.querySelector('.trigger');
        const toolTip = document.querySelector('.tooltip');
        const placement = {!! json_encode($placement ?? 'auto') !!}

        window.Popper(trigger, toolTip, {
            placement
        })
    </script>
@endsection
