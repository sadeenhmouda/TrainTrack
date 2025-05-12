<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Improve Your Match – Fallback</title>
  <link rel="stylesheet" href="{{ asset('css/fallbackimprove.css') }}">
</head>
<body>
  <div class="fallback-container">
    <div class="fallback-header"><div class="card-section">
      <h2><span class="highlight">You're Close!</span></h2>
      <p>To improve your results, we recommend that you choose at least one option from each category that definitely applies to you.</p>
    </div></div>

    <!-- Recommended Subjects -->
<div class="card-section">
  <h3>⚡ Recommended Subjects</h3>
  <div id="subjectList" class="pill-container"></div>
</div>

<!-- Recommended Technical Skills -->
<div class="card-section">
  <h3>⚡ Recommended Technical Skills</h3>
  <div id="technicalSkillList" class="pill-container"></div>
</div>

<!-- Recommended Non-Technical Skills -->
<div class="card-section">
  <h3>🌟 Recommended Non - Technical Skills</h3>
  <div id="nonTechnicalSkillList" class="pill-container"></div>
</div>

    <!-- Buttons -->
    <div class="fallback-buttons">
      <button onclick="window.location.href='/summaryresults'" class="btn skip-btn">Skip, maybe later</button>
      <button id="submitImprovementBtn" class="btn submit-btn">Submit</button>
    </div>
  </div>

  <script src="{{ asset('js/fallbackimprove.js') }}"></script>
</body>
</html>
