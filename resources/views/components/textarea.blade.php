<div class="{{ $groupClass ?? '' }}">
    <label for="{{ $name }}" class="{{ $required ?? '' }}">{{ $labelName }}</label>
    <textarea class="form-control form-control-sm rounded-0 shadow-none {{ $class ?? '' }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" rows="{{ $rows ?? '3' }}">{{ $value ?? '' }}</textarea>
    @isset($name)
        @error($name)
            <small class="text-danger d-block text-start">{{ $message }}</small>
        @enderror
    @endisset
</div>
