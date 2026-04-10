<div class="form-group {{ $errors->has($field['name']) ? ' has-error' : '' }}">

    <input type="{{ $field['type'] }}"
            name="{{ $field['name'] }}"
            class="{{ $errors->first($field['name']) ? ' is-invalid' : '' }}"
            id="{{ $field['name'] }}"
            {{ (old($field['name'], \setting($field['name'])) == 'on' ? 'checked' : '') }}
            placeholder="{{ $field['label'] }}">
    <label for="{{ $field['name'] }}" class="control-label">{{ $field['label'] }}</label>
    @if ($errors->has($field['name'])) <div class="invalid-feedback">{{ $errors->first($field['name']) }}</div> @endif
</div>
