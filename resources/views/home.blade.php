<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>La Boutique Du Sneaker</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">



    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin: 0;
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
<div id="app">
    <App></App>
</div>
<script src="https://kit.fontawesome.com/0b031d1238.js" crossorigin="anonymous"></script>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
