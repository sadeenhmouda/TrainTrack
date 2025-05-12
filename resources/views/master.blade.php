<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TrainTrack Wizard</title>

  <!-- Global Fonts and Styles -->
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @yield('styles')
  
</head>
<body class="wizard-body" style="font-family: 'Roboto', sans-serif; background-color: #f9f9f9;">

  <div class="wizard-layout" style="display: flex; min-height: 100vh;">

    {{-- Left Sidebar (Step Guide) --}}
    @include('traintrack.partials.sidebar', ['currentStep' => 6])

    {{-- Right Content Section --}}
    <div class="flex-1 p-6 overflow-y-auto">
      @yield('content')
    </div>
  </div>

  @yield('scripts')
</body>
</html>
