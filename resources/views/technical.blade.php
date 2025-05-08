<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Technical Skills | Train Track Wizard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/tec.css') }}">
</head>
<body class="wizard-body">
  <div class="wizard-layout">

    {{-- Left Sidebar --}}
    @include('traintrack.partials.sidebar')

    <!-- Right Side -->
    <div class="tec-content" x-data="technicalSkillsStep()">
      <h1 class="tec-title">🧠 Technical Skills</h1>
      <p class="tec-subtitle">We recommend selecting up to 7 strongest technical skills.</p>

      <!-- Skills will be injected here -->
      <div id="skills-container" class="tec-skill-container"></div>

      <!-- Navigation Buttons -->
      <div class="tec-footer">
        <a href="{{ route('traintrack.subject2') }}">
          <button class="btn-back">Back</button>
        </a>
        <button class="btn-next" @click="saveAndGoNext()">Next</button>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <script src="{{ asset('js/tec.js') }}"></script>
</body>
</html>
