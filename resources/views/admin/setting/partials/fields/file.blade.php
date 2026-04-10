<div class="form-group {{ $errors->has($field['name']) ? ' has-error' : '' }}">
    <label for="{{ $field['name'] }}" class="control-label">{{ $field['label'] }}</label>
    <input type="{{ $field['type'] }}"
            name="{{ $field['name'] }}"
            value="{{ old($field['name'], \setting($field['name'])) }}"
            class="form-control {{ Arr::get( $field, 'class') }} {{ $errors->first($field['name']) ? ' is-invalid' : '' }}"
            id="{{ $field['name'] }}"
            placeholder="{{ $field['label'] }}">
    @if ($errors->has($field['name'])) <div class="invalid-feedback">{{ $errors->first($field['name']) }}</div> @endif
</div>
