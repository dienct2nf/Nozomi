 <div class="form-group {{ $errors->has($field['name']) ? ' has-error' : '' }}">
    <label for="{{ $field['name'] }}" class="control-label required">{{ $field['label'] }}</label>
    <textarea name="{{ $field['name'] }}" rows="3"
              value="{{ old($field['name'], \setting($field['name'])) }}"
              class="form-control {{ Arr::get( $field, 'class') }} {{ $errors->first($field['name']) ? ' is-invalid' : '' }}"
              id="{{ $field['name'] }}"
              placeholder="{{ $field['label'] }}">{{ old($field['name'], \setting($field['name'])) }}</textarea>
    @if ($errors->has($field['name'])) <div class="invalid-feedback">{{ $errors->first($field['name']) }}</div> @endif
</div>

@push('js')
<script type="text/javascript">
    $(document).ready(function(){
        var o1 = ckeditorOptions;
        o1.width = '100%';
        o1.height = '150';
        CKEDITOR.replace(
            '{{ $field['name'] }}',
            o1,
            );
        });
    </script>
@endpush
