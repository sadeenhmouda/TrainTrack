<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Train Track Wizard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="css/step1.css"> <!-- your step-specific CSS -->
  <script src="js/theme.js" defer></script>    <!-- shared theme loader -->
</head>

<body class="wizard-body">
  <div class="wizard-layout">

    {{-- ✅ Left Sidebar --}}
    @include('traintrack.partials.sidebar', [
      'currentStep' => 1,
      'currentSubstep' => null
    ])

    {{-- ✅ Right Form Area --}}
    <div class="form-area">
      <h1 class="form-title">👋 Let’s Get to Know You</h1>
      <p class="form-subtitle">Please fill out your personal information below</p>

      <form>

        {{-- ✅ Full Name Field --}}
        <div class="form-group">
          <label for="fullName">Full Name</label>
          <input type="text" id="fullName" name="Enter your full name">
        </div>

        {{-- ✅ Gender Selection --}}
        <div class="form-group">
          <label>Gender</label>
          <div class="button-group">
            <button type="button" class="option-button">🧔 Male</button>
            <button type="button" class="option-button">👩 Female</button>
          </div>
        </div>

        {{-- ✅ Date of Birth --}}
        <div class="form-group dob-group">
          <label class="dob-label">Date of Birth</label>
          <div class="dob-selects" style="display: flex; gap: 10px;">
            
            <!-- Month -->
            <div class="custom-dropdown" id="monthDropdown">
              <div class="selected">Month</div>
              <ul class="options"></ul>
            </div>

            <!-- Day -->
            <div class="custom-dropdown" id="dayDropdown">
              <div class="selected">Day</div>
              <ul class="options"></ul>
            </div>

            <!-- Year -->
            <div class="custom-dropdown" id="yearDropdown">
              <div class="selected">Year</div>
              <ul class="options"></ul>
            </div>
          </div>
        </div>

        {{-- ✅ Major Selection --}}
        <div class="form-group">
          <label>Major</label>
          <div class="major-options" id="majorOptions">
            <!-- JS will populate major pills here -->
          </div>
        </div>

        {{-- ✅ Submit Button --}}
        <div class="form-buttons">
          <button type="submit" class="next">Next</button>
        </div>

      </form>
    </div>
  </div>

  <!-- ✅ Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/alert.js') }}"></script>
  <script src="{{ asset('js/first.js') }}"></script>
  <script src="js/theme.js" defer></script>
</body>
</html>
