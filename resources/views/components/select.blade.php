<div class="mb-2 {{ $groupClass ?? '' }}">
    @if (!empty($label))
    <label for="{{ $name }}" class="{{ $required ?? '' }}">{{ $label }}</label>
    @endif
    <select name="{{ $name }}" @if(!empty($dataSearch)) data-live-search="{{ $dataSearch }}" @endif id="{{ $name }}" class="form-control form-control-sm rounded-0 shadow-none {{ $class ?? '' }}" @if(!empty($onchange)) onchange="{{ $onchange }}" @endif @if(!empty($multiple)) multiple @endif>
        {{ $slot }}
    </select>
    @isset($error)
        @error($error)
            <small class="text-danger d-block text-start">{{ $message }}</small>
        @enderror
    @endisset
</div>
