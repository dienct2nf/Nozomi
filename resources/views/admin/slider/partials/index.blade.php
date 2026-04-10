<div class="card">
    <div class="card-header">
        <span>Content</span>
    </div>
    <div class="card-body">
        <div class="form-group">
            {{ Form::label("title_$language", 'Title', ['class' => [$validated? 'required' : '', 'control-label']]) }}
            {{ Form::text("title_$language",
                        old("title_$language") ? old("title_$language") : (!empty($slider) ? $slider->translate($language)->title : null),
                        [
                            "class" => 'google-preview form-control ' . ( $errors->has('title_'.$language) ? ' is-invalid' : '' ),
                            "placeholder" => "Title",
                        ])
            }}
            @if($errors->has("title_$language"))
                <div class="invalid-feedback">
                    {{ $errors->first("title_$language") }}
                </div>
            @endif
        </div>
        <div class="form-group">
            {{ Form::label("description_$language", 'Description', ['class' => [$validated? 'required' : '', 'control-label']]) }}
            {{ Form::textarea("description_$language",
                        old("description_$language") ? old("description_$language") : (!empty($slider) ? $slider->translate($language)->description : null),
                        [
                            "class" => 'form-control ' . ( $errors->has('description_'.$language) ? ' is-invalid' : '' ),
                            "rows" => "5",
                            "placeholder" => "description",
                        ])
            }}
            @if($errors->has("description_$language"))
                <div class="invalid-feedback">
                    {{ $errors->first("description_$language") }}
                </div>
            @endif
        </div>
    </div>
</div>
