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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>

<body class="wizard-body">
  <div class="wizard-layout">

    {{-- ✅ Sidebar --}}
       @include('traintrack.partials.sidebar', [
  'currentStep' => 6,
  'currentSubstep' => null
])

    {{-- ✅ Right Side --}}
    <div class="summary-area">
      <h1 class="summary-title">🎯 Summary & Results</h1>
      <p class="summary-sub">✨ The right track starts here. ✨</p>

      <!-- ✅ Export Date (Initially Hidden) -->
      <p id="exportDate" style="display: none; font-size: 14px; margin-top: 10px;">📅 Exported On: </p>

      <!-- ✅ Required for JS to work -->
      <div id="positionResultsContainer"></div>

      <!-- Footer Buttons -->
      <div class="summary-actions">
        <button onclick="window.location.href='/traintrack/selections'" class="back-button">🔗 My Selections</button>
        <button onclick="restartWizard()">🔁 Restart Wizard</button>
        <button onclick="goHome()">🏠 Home</button>
        <button id="downloadPdfBtn" class="export-btn">📝 Export PDF</button>
      </div>
    </div>
  </div>

  <!-- ✅ Attach JavaScript Logic -->
  <script src="{{ asset('js/summary.js') }}"></script>
  <script>
    // ✅ Home redirection function
    function goHome() {
      window.location.href = "/";
    }

    // ✅ Export PDF logic
    document.getElementById("downloadPdfBtn").addEventListener("click", () => {
      const element = document.querySelector(".summary-area");
      const exportDate = document.getElementById("exportDate");

      // ✅ Format today's date and show it
      const today = new Date().toISOString().split("T")[0];
      exportDate.textContent = `📅 Exported On: ${today}`;
      exportDate.style.display = "block";

      const opt = {
        margin: 0.5,
        filename: `TrainTrack_Report_${today}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
      };

      // ✅ Generate and download PDF, then hide export date again
      html2pdf().set(opt).from(element).save().then(() => {
        exportDate.style.display = "none";
      });
    });
  </script>
</body>
</html>
