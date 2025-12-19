<!DOCTYPE html>
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

</html>
