<fieldset style="max-width: 800px">
    <legend>
        {{ $field['label'] }}
    </legend>

    @foreach($field['fields'] as $f1)
        @includeIf('admin.setting.partials.fields.' . $f1['type'], ['field' => $f1] )
    @endforeach
</fieldset>


