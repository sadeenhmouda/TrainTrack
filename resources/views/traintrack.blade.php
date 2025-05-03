<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Train Track Wizard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
</head>

<body class="wizard-body">
  <div class="wizard-layout">
    {{-- Left Sidebar --}}
    @include('traintrack.partials.sidebar')

    {{-- Right Form Area --}}
    <div class="form-area">
      <h1 class="form-title">👋 Let’s Get to Know You</h1>
      <p class="form-subtitle">Please fill out your personal information below</p>

      <form>
        <!-- Full Name -->
        <div class="form-group">
          <label for="fullName">Full Name</label>
          <input type="text" id="fullName" placeholder="Enter your full name">
        </div>

        <!-- Gender -->
        <div class="form-group">
          <label>Gender</label>
          <div class="button-group">
            <button type="button" class="option-button">🧔 Male</button>
            <button type="button" class="option-button">👩 Female</button>
          </div>
        </div>

        <!-- Date of Birth (Dropdown Style) -->
        <div class="form-group dob-group">
          <label class="dob-label">Date of Birth</label>
          <div class="dob-selects" style="display: flex; gap: 10px;">
            <select id="dob-month" required>
              <option value="" disabled selected>Month</option>
              <option value="01">January</option>
              <option value="02">February</option>
              <option value="03">March</option>
              <option value="04">April</option>
              <option value="05">May</option>
              <option value="06">June</option>
              <option value="07">July</option>
              <option value="08">August</option>
              <option value="09">September</option>
              <option value="10">October</option>
              <option value="11">November</option>
              <option value="12">December</option>
            </select>

            <select id="dob-day" required>
              <option value="" disabled selected>Day</option>
              <!-- JS will populate 1–31 -->
            </select>

            <select id="dob-year" required>
              <option value="" disabled selected>Year</option>
              <!-- JS will populate years -->
            </select>
          </div>
        </div>

        <!-- Major -->
        <div class="form-group">
          <label>Major</label>
          <div class="major-options">
            <span class="major-pill">☁️ Computer Science Apprenticeship Program</span>
            <span class="major-pill">💼 Management Information System</span>
            <span class="major-pill">🛠️ Computer Engineering</span>
            <span class="major-pill">💻 Computer Science</span>
            <span class="major-pill">🔐 Cyber Security</span>
          </div>
        </div>

        <!-- Buttons -->
        <div class="form-buttons">
          <button type="submit" class="next">Next</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Your Scripts -->
  <script src="{{ asset('js/first.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/alert.js') }}"></script>

  <!-- Populate Days and Years -->
  <script>
    // Populate Day 1–31
    const daySelect = document.getElementById("dob-day");
    for (let i = 1; i <= 31; i++) {
      const day = i.toString().padStart(2, '0');
      daySelect.innerHTML += `<option value="${day}">${day}</option>`;
    }

    // Populate Years from current back to 1950
    const yearSelect = document.getElementById("dob-year");
    const currentYear = new Date().getFullYear();
    for (let y = currentYear; y >= 1950; y--) {
      yearSelect.innerHTML += `<option value="${y}">${y}</option>`;
    }
  </script>

  <!-- Resume + Exit Handling -->
  <script>
    // ✅ 1. Ask to resume
    handleWizardResume();

    // ✅ 2. Warn before leaving
    warnBeforeExit(() => {
      const name = document.getElementById("fullName")?.value.trim();
      const gender = document.querySelector(".option-button.selected");
      const major = document.querySelector(".major-pill.selected");
      const day = document.getElementById("dob-day")?.value;
      const month = document.getElementById("dob-month")?.value;
      const year = document.getElementById("dob-year")?.value;

      return name || gender || major || (day && month && year);
    });
  </script>
</body>
</html>
