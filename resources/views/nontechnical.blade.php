<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Train Track Wizard – Non-Technical Skills</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/nontechnicalskills.css') }}">
</head>

<body class="wizard-body">
  <div class="wizard-layout">

    <!-- Sidebar -->
       @include('traintrack.partials.sidebar', [
  'currentStep' => 4,
  'currentSubstep' => null
])

    <!-- Right Panel -->
    <div class="right-panel" x-data="nonTechnicalSkillsStep()">

      <!-- Titles -->
      <h1 class="section-title">💬 Non-Technical Skills</h1>
      <p class="section-subtitle">Choose 3 to 5 soft skills you feel most confident in.</p>

      <!-- Counter -->
      <div id="nontech-counter" class="nontech-counter">Selected: 0</div>

      <!-- Skills Grid -->
      <div id="skills-container" class="skills-grid"></div>

      <!-- Navigation Buttons -->
      <div class="wizard-buttons">
        <a href="{{ route('traintrack.technical') }}">
          <button class="btn-outline">Back</button>
        </a>
        <button id="nextBtn" class="btn-next" disabled>Next</button>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <script src="{{ asset('js/non.v2.js') }}"></script>
</body>
</html>
