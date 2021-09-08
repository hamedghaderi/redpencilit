@props(['message', 'type' => 'success'])

@php
    $color = '';
        switch($type) {
            case 'success':
                $color = 'green';
                break;
            case 'danger':
                $color = 'red';
                break;
            case 'warning':
                $color = 'yellow';
                break;
            case 'info':
                $color = 'blue';
                break;
            default:
                $color = 'green';
                break;
        }
@endphp

<div class="fixed bottom-0 max-w-md bg-{{ $color }}-500 text-{{ $color }}-100 px-4 py-2 mb-4 rounded-lg @if(app()->getLocale() === 'fa') left-0 ml-4 @else right-0 mr-4 @endif">
    {!! $message !!}
</div>
