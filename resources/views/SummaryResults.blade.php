<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Train Track – Summary & Results</title>
  <link rel="stylesheet" href="/css/first.css">
  <link rel="stylesheet" href="/css/sidebar.css">
  <link rel="stylesheet" href="/css/summary.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="wizard-body">
  <div class="wizard-layout">
    <!-- Sidebar -->
    @include('traintrack.partials.sidebar', ['currentStep' => 6])

    <!-- Summary Content -->
    <div class="summary-area">
      <h1 class="summary-title">🎯 Summary & Results</h1>
      <p class="summary-sub">✨ The right track starts here. ✨</p>

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

  <script src="/js/summary.js"></script>
</body>
</html>
