<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fallback Suggestions</title>
  <link href="{{ asset('css/fallback.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  @yield('styles')
</head>
<body class="bg-[#f9f9f9] font-['Roboto']">

  <main class="flex flex-col items-center justify-center min-h-screen p-6">
    @yield('content')
  </main>

  @yield('scripts')
</body>
</html>
