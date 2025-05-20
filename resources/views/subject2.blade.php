<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Train Track Wizard</title>

  <!-- Fonts & Styles -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/subtopics.css') }}">
</head>

<body class="wizard-body">
  <div class="wizard-layout">

    {{-- ✅ Left Sidebar --}}
      @include('traintrack.partials.sidebar', [
  'currentStep' => 2,
  'currentSubstep' => '2.2'
])

    {{-- ✅ Right Side --}}
    <div class="subject-form">

      <!-- Title & Subtitle -->
      <h1 class="subject-title">📚 Subject of Interest</h1>
      <p class="subject-subtitle">
        Nice, choose <strong>7 max topics</strong> — at least one from each of the 3 categories.
      </p>
      <span class="subject-counter">Selected <span id="selectedCount">0</span>/7</span>

      <!-- Topic Buttons Area -->
      <div class="topics-container" id="topicsContainer"></div>

      <!-- Warning Message -->
      <p id="selectionWarning" style="color: #d32f2f; font-size: 14px; display: none;">
        ⚠️ Please select at least one topic from each of the 3 categories.
      </p>

      <!-- Navigation Buttons -->
      <div class="subject-buttons">
        <a href="{{ route('traintrack.subject') }}">
          <button class="btn-back">Back</button>
        </a>
        <button class="btn-next" id="nextBtn" disabled>Next</button>
      </div>

    </div>
  </div>

  <!-- JS -->
  <script src="{{ asset('js/subtopics.js') }}" defer></script>
</body>
</html>
