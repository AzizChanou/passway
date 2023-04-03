<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title inertia>{{ config('app.name', 'Laravel') }}</title>

  <link rel="shortcut icon" href="{{asset('assets/img/logo_light.svg')}}" type="image/x-icon">
  <link href="{{asset('assets/webfonts/uicons-solid-rounded.css')}}" rel="stylesheet">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @routes
  @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
  @inertiaHead
</head>
<style>
  ::-webkit-scrollbar {
    width: 12px;
    height: 12px;
  }

  ::-webkit-scrollbar-track {
    background: #574E8A50;
  }

  ::-webkit-scrollbar-thumb {
    background: #0f213a;
  }

  ::-webkit-scrollbar-thumb:hover {
    background: #0f213a60;
  }
</style>

<body class="font-sans antialiased">
  @inertia
</body>

</html>