<style>
    .sidebar {
        width: 260px;
        background: #1f2937;
        min-height: 100vh;
        padding: 10px;
    }

    .menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .menu-item {
        margin-bottom: 5px;
        overflow: hidden;
    }

    .menu-btn,
    .menu-link {
        width: 100%;
        background: none;
        border: none;
        color: #e5e7eb;
        text-align: left;
        padding: 12px;
        font-size: 15px;
        cursor: pointer;
        border-radius: 6px;
        display: block;
        text-decoration: none;

    }

    .menu-btn:hover,
    .menu-link:hover {
        background: #374151;
    }

    .submenu {
        list-style: none;
        padding-left: 15px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .submenu.open {
        max-height: 500px;
    }

    .submenu a {
        display: block;
        padding: 10px;
        color: #d1d5db;
        text-decoration: none;
        font-size: 14px;
        border-radius: 5px;
    }

    .submenu a:hover {
        background: #4b5563;
    }
</style>

<div class="sidebar">
    <ul class="menu">
        @php
            $menus = getSiderbarMenu();
        @endphp

        @foreach ($menus as $menu)
            {{-- level 1 --}}
            <li class="menu-item">

                @if ($menu->children->count())
                    <button class="menu-btn" onclick="toggleMenu(this)">
                        {{ $menu->title }}
                    </button>
                    {{-- level 2 --}}
                    <ul class="submenu">
                        @foreach ($menu->children as $child)
                            <li>
                                <a href="{{ $child->url }}">{{ $child->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <a href="{{ $menu->url }}" class="menu-link">
                        {{ $menu->title }}
                    </a>
                @endif

            </li>
        @endforeach


    </ul>
</div>

<script>
    function toggleMenu(button) {
        const submenu = button.nextElementSibling;

        document.querySelectorAll('.submenu').forEach(menu => {
            if (menu !== submenu) {
                menu.classList.remove('open');
            }
        });

        submenu.classList.toggle('open');
    }
</script>
