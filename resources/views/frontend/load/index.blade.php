<div class="band">
    @php ($i=1)
    @foreach ($post as $item)
        @if ($i<=2)
            <div class="item-{{$i}}">
                <a href="/{{ $item->slug }}" class="card">
                    <div class="thumb" style="background-image: url({{!is_null($item->img)? '/uploads/'.$item->img : setting('thumbnail') }});"></div>
                    <article>
                    <h3>{{ $item->title }}</h3>
                    <span>{{ $item->categories->first()->title }}</span>
                    </article>
                </a>
            </div>
        @else
            <div class="item-{{$i}}">
                <a href="/{{ $item->slug }}" class="card">
                    <div class="thumb" style="background-image: url({{!is_null($item->img)? '/uploads/'.$item->img : setting('thumbnail') }});"></div>
                    <article>
                    <h4>{{ $item->title }}</h4>
                    <span>{{ $item->created_at->format('d/m/Y') }}</span>
                    </article>
                </a>
            </div>
        @endif
    @php ($i++)
    @endforeach
