<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <style>
    body{
      background-color:  whitesmoke
    }
  </style>
</head>
<body>
    @yield('title')
    @yield('content')
</body>
</html>