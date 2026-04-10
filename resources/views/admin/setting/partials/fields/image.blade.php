<div class="form-group {{ $errors->has($field['name']) ? ' has-error' : '' }} {{ Arr::get( $field, 'class') }}">
    <label for="{{ $field['name'] }}" class="control-label">{{ $field['label'] }}</label>
    <div class="showthumb">
        <span id="delete-thumb_{{ $field['name'] }}" data-toggle="tooltip" title="Delete Thumbnail" class="showthumb--delete"><i class="fas fa-minus-circle"></i></span>
        <input id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control" type="hidden" value="{{ old($field['name'], \setting($field['name'])) }}">
        <div id="lfm_{{ $field['name'] }}" data-input="{{ $field['name'] }}" data-preview="holder_{{ $field['name'] }}">
            <img id="holder_{{ $field['name'] }}" class="showthumb--beautifull" src="{{ old($field['name'], \setting($field['name'])) }}">
        </div>
    </div>
    @if ($errors->has($field['name'])) <div class="invalid-feedback" style="display: block">{{ $errors->first($field['name']) }}</div> @endif
</div>
@push('js')
   <script>
       $(function () {
            $('#lfm_{{ $field['name'] }}').filemanager('image'); // load
            var noimg = '{{ \setting('thumbnail') }}';
            $('[data-toggle="tooltip"]').tooltip()
            $('#delete-thumb_{{ $field['name'] }}').click(function() {
                $('#{{ $field['name'] }}').val('');
                $('#holder_{{ $field['name'] }}').attr('src', noimg);
            });
        })
   </script>
@endpush
