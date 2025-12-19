<ul class="menu">
    @foreach ($menus as $menu)
        <li>
            <a href="{{ $menu->url ?? 'javascript:void(0)' }}">
                {{ $menu->title }}
            </a>

            @if ($menu->children->count())
                @include('components.menu', ['menus' => $menu->children])
            @endif
        </li>
    @endforeach
</ul>
