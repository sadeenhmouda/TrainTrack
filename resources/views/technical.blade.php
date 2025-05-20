<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Technical Skills | Train Track Wizard</title>

  <!-- Fonts & Styles -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link href="{{ asset('css/first.css') }}" rel="stylesheet">
  <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
  <link href="{{ asset('css/tec.css') }}" rel="stylesheet">
</head>

<body class="wizard-body">
  <div class="wizard-layout">

    <!-- ✅ Left Sidebar -->
      @include('traintrack.partials.sidebar', [
  'currentStep' => 3,
  'currentSubstep' => null
  ])

    <!-- ✅ Right Content Area -->
    <div class="tec-content" x-data="technicalSkillsStep()">

      <!-- ✅ Title -->
      <h1 class="tec-title">🧠 Technical Skill</h1>
      <p class="tec-subtitle">
        Select the technical skills you’re strongest in — you can choose between 3 and 8.
      </p>

      <!-- ✅ Counter (moved outside <p>) -->
      <div class="selection-line">
        <span id="selected-counter" class="tec-counter">Selected: 0</span>
      </div>

      <!-- ✅ Skills will be injected here by JS -->
      <div id="technical-skills-list" class="tec-skill-container">
        <!-- Filled dynamically by JS -->
      </div>

      <!-- ✅ Selected Pills -->
      <div id="selected-skills-wrapper" class="selected-wrapper">
        <p class="selected-label">✅ Selected Skills</p>
        <div id="selected-skills-box" class="selected-scroll-box"></div>
      </div>

      <!-- ✅ Navigation Buttons -->
      <div class="tec-footer">
        <a href="{{ route('traintrack.subject2') }}">
          <button class="btn-back">Back</button>
        </a>
        <button class="btn-next" id="nextBtn">Next</button>
      </div>

    </div>
  </div>

  <!-- ✅ Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <script src="{{ asset('js/tec.js') }}"></script>

  <!-- ✅ Optional fallback in JS-only mode -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const nextBtn = document.getElementById("nextBtn");
      if (nextBtn) {
        nextBtn.addEventListener("click", () => {
          const logic = technicalSkillsStep();
          logic.saveAndGoNext();
        });
      }
    });
  </script>
</body>
</html>
