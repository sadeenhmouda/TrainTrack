<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Final Selections – Train Track</title>
  <link rel="stylesheet" href="/css/selections.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet" />
</head>
<body>

  <!-- 🔄 Loading Spinner -->
  <div id="loadingSpinner" style="text-align: center; padding: 40px;">
    <p style="font-size: 18px; color: #6a1b9a;">⏳ Loading your selections...</p>
  </div>

  <!-- ✅ Page Content (initially hidden) -->
  <div id="selectionContent" class="page-container" style="display: none;">
    <!-- Header -->
    <div class="header-stack">
      <a href="/">
        <img src="/traintracklogo.png" alt="Train Track Logo" class="logo" />
      </a>
      <h1 class="page-heading">🎯 Your Final Selections</h1>
    </div>

    <!-- Basic Info -->
    <div class="info-card inline-pair"><h2>🧑‍🎓 Full Name:</h2><span id="fullName"></span></div>
    <div class="info-card inline-pair"><h2>🚻 Gender:</h2><span id="gender"></span></div>
    <div class="info-card inline-pair"><h2>🧠 Major:</h2><span id="major"></span></div>
    <div class="info-card inline-pair"><h2>📅 Date of Birth:</h2><span id="dob"></span></div>

    <!-- Required Selections -->
    <div class="info-card"><h2>📘 Selected Subjects</h2><ol id="subjectList"></ol></div>
    <div class="info-card"><h2>💻 Selected Technical Skills</h2><ol id="technicalSkillList"></ol></div>
    <div class="info-card"><h2>🤝 Selected Non-Technical Skills</h2><ol id="nonTechnicalSkillList"></ol></div>

    <!-- Optional Preferences (conditionally shown) -->
    <div class="info-card inline-pair" id="trainingModeCard"><h2>🏢 Training Mode:</h2><span id="trainingMode"></span></div>
    <div class="info-card inline-pair" id="companySizeCard"><h2>🏬 Company Size:</h2><span id="companySize"></span></div>
    <div class="info-card" id="cultureCard"><h2>🎯 Preferred Culture</h2><ol id="cultureList"></ol></div>
    <div class="info-card" id="industryCard"><h2>🏭 Preferred Industry</h2><ol id="industryList"></ol></div>

    <!-- Back Button -->
    <a href="{{ route('traintrack.summaryresults') }}" class="back-button">
      <span class="arrow-icon">←</span> Back to Results
    </a>
  </div>

  <script src="/js/selections.js"></script>
</body>
</html>
