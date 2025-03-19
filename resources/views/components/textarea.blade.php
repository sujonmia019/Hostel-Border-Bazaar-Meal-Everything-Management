<div class="{{ $groupClass ?? '' }} mb-2">
    <label for="{{ $name }}" class="{{ $required ?? '' }}">{{ $label }}</label>
    <textarea class="form-control form-control-sm rounded-0 shadow-none {{ $class ?? '' }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" rows="{{ $rows ?? '3' }}">{{ $value ?? '' }}</textarea>
    @if (!empty($optional))
    <small class="d-block">{{ $optional }}</small>
    @endif
    @isset($name)
        @error($name)
            <small class="text-danger d-block text-start">{{ $message }}</small>
        @enderror
    @endisset
</div>
