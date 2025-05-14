<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Train Track – Summary & Results</title>

  <!-- Fonts & Styles -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/summary.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="wizard-body">
  <div class="wizard-layout">

    {{-- ✅ Sidebar --}}
    @include('traintrack.partials.sidebar', ['currentStep' => 6])

    {{-- ✅ Right Side --}}
    <div class="summary-area">
      <h1 class="summary-title">🎯 Summary & Results</h1>
      <p class="summary-sub">✨ The right track starts here. ✨</p>

      <!-- ✅ Required for JS to work -->
      <div id="positionResultsContainer"></div>

      <!-- Footer Buttons -->
      <div class="summary-actions">
        <button onclick="goToSelections()">🔗 My Selections</button>
        <button onclick="restartWizard()">🔁 Restart Wizard</button>
        <button onclick="goHome()">🏠 Home</button>
        <button onclick="exportPDF()">📝 Export PDF</button>
      </div>
    </div>
  </div>

  <!-- ✅ Attach JavaScript Logic -->
  <script src="{{ asset('js/summary.js') }}"></script>
</body>
</html>
