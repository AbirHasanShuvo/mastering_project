{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dynamic Menu</title>
    <style>
        ul.menu,
        ul.menu ul {
            list-style: none;
            padding-left: 15px;
        }

        ul.menu li {
            margin: 5px 0;
        }

        ul.menu a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>

<body>

    <h2>Dynamic Menu</h2>

    @include('components.menu', ['menus' => $menus])

</body>

</html> --}}

{{-- re designed --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Menu</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 260px;
            background: #1f2937;
            /* dark admin color */
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
            /* enough for animation */
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
</head>

<body>

    <div class="sidebar">
        <ul class="menu">
            @foreach ($menus as $menu)
                <li class="menu-item">

                    @if (count($menu->children))
                        <button class="menu-btn" onclick="toggleMenu(this)">
                            {{ $menu->title }}
                        </button>

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

            // close other open submenus (admin behavior)
            document.querySelectorAll('.submenu').forEach(menu => {
                if (menu !== submenu) {
                    menu.classList.remove('open');
                }
            });

            submenu.classList.toggle('open');
        }
    </script>

</body>

</html>
