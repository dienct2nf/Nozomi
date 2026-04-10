<div class="card">
    <div class="card-header">
        <span> {{ __('label.body') }}</span>
    </div>
    <div class="card-body">
        <div class="form-group">
            {{ Form::label("title_$language", __('label.title'), ['class' => [$validated? 'required' : '', 'control-label']]) }}
            <div class="count_char">
                {{ Form::text("title_$language",
                            old("title_$language") ? old("title_$language") : (!empty($category) ? $category->translate($language)->title : null),
                            [
                                "class" => 'google-preview form-control input-char-count ' . ( $errors->has('title_'.$language) ? ' is-invalid' : '' ),
                                "placeholder" => __('label.title'),
                                "maxlength" => "120",
                            ])
                }}
            </div>
            @if($errors->has("title_$language"))
                <div class="invalid-feedback">
                    {{ $errors->first("title_$language") }}
                </div>
            @endif
        </div>
        @can('admin-create')
            <div class="form-group">
                <div class="count_char">
                    {{ Form::text("slug",
                                old("slug") ? old("slug") : (!empty($category) ? $category->slug : null),
                                [
                                    "class" => 'google-preview form-control input-char-count',
                                    "placeholder" => "Slug",
                                    "id" => "slug_$language",
                                    "maxlength" => "120",
                                ])
                    }}
                </div>
            </div>
            @else
            <div class="form-group">
                <div class="count_char">
                    {{ Form::text("slug",
                                old("slug") ? old("slug") : (!empty($category) ? $category->slug : null),
                                [
                                    "class" => 'google-preview form-control input-char-count',
                                    "placeholder" => "Slug",
                                    "id" => "slug_$language",
                                    "maxlength" => "120",
                                    "readonly" => "readonly"
                                ])
                    }}
                </div>
            </div>
        @endcan
        <div class="form-group">
            {{ Form::label("description_$language", __('label.description'), ['class' => [$validated? 'required' : '', 'control-label']]) }}
            <div class="count_char">
                {{ Form::textarea("description_$language",
                            old("description_$language") ? old("description_$language") : (!empty($category) ? $category->translate($language)->description : null),
                            [
                                "class" => 'form-control input-char-count ' . ( $errors->has('description_'.$language) ? ' is-invalid' : '' ),
                                "rows" => "5",
                                "placeholder" => __('label.description'),
                                "maxlength" => \setting('description_length'),
                            ])
                }}
            </div>
            @if($errors->has("description_$language"))
                <div class="invalid-feedback">
                    {{ $errors->first("description_$language") }}
                </div>
            @endif
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <span>{{ __('label.p_seo') }}</span>
    </div>
    <div class="card-body">
        <div class="form-group">
            {{ Form::label("title_seo_$language", __('label.seo_title'), ['class' => [$validated? 'required' : '', 'control-label']]) }}
            <div class="count_char">
                {{ Form::text("title_seo_$language",
                            old("title_seo_$language") ? old("title_seo_$language") : (!empty($category) ? $category->translate($language)->title_seo : null),
                            [
                                "class" => 'google-preview form-control input-char-count ' . ( $errors->has('title_seo_'.$language) ? ' is-invalid' : '' ),
                                "placeholder" => __('label.seo_title'),
                                "maxlength" => \setting('title_length'),
                            ])
                }}
            </div>
            @if($errors->has("title_seo_$language"))
                <div class="invalid-feedback">
                    {{ $errors->first("title_seo_$language") }}
                </div>
            @endif
        </div>
        <div class="form-group">
            {{ Form::label("description_seo_$language", __('label.seo_description'), ['class' => [$validated? 'required' : '', 'control-label']]) }}
            <div class="count_char">
                {{ Form::textarea("description_seo_$language",
                            old("description_seo_$language") ? old("description_seo") : (!empty($category) ? $category->translate($language)->description_seo : null),
                            [
                                "class" => 'google-preview form-control input-char-count' . ( $errors->has('description_seo_'.$language) ? ' is-invalid' : '' ),
                                "rows" => "3",
                                "placeholder" => __('label.seo_description'),
                                "maxlength" => \setting('description_length'),
                            ])
                }}
            </div>
            @if($errors->has("description_seo_$language"))
                <div class="invalid-feedback">
                    {{ $errors->first("description_seo_$language") }}
                </div>
            @endif
        </div>
        <div class="form-group">
            @include('admin.post.partials.google', [
                                'id' => $key
                            ])
        </div>
    </div>
</div>
