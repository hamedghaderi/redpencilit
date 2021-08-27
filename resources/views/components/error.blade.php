@props(['name'])

@error($name)
<div class="feedback feedback--invalid my-2">
    <p>
        {{ $message }}
    </p>
</div>
@enderror
