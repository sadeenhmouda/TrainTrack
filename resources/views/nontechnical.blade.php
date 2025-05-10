<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Train Track Wizard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/nontechnicalskills.css') }}">
</head>
<body class="wizard-body">
  <div class="wizard-layout">
    {{-- ✅ Left Sidebar --}}
    @include('traintrack.partials.sidebar')

    {{-- ✅ Right Panel: Non-Technical Skills --}}
    <div class="right-panel" x-data="nonTechnicalSkillsStep()">
      <!-- ✅ Section Title + Subtitle -->
      <h1 class="section-title">💬 Non-Technical Skills</h1>
      <p class="section-subtitle">Choose 2 min soft skills you feel most confident in.</p>

      <!-- ✅ Live Counter -->
      <div class="selection-counter" x-text="'Selected ' + selectedSkills.length"></div>

      <!-- ✅ Skills Grid (Populated by JS) -->
      <div id="skills-container" class="skills-grid"></div>

      <!-- ✅ Bottom Buttons (Fixed Position) -->
      <div class="wizard-buttons">
        <a href="{{ route('traintrack.technical') }}">
          <button id="backBtn" class="btn-outline">Back</button>
        </a>

        <button id="nextBtn" class="btn-next" disabled>Next</button>
      </div>
    </div>
  </div>

  <!-- ✅ JS Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>

  <!-- ✅ JS Logic -->
  <script src="{{ asset('js/non.js') }}"></script>
</body>
</html>
