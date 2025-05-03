<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Summary & Results</title>
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">

</head>
<body>

  <!-- 📘 Main Layout -->
  <div class="wizard-layout">

    <!-- 🟣 Left Sidebar -->
    <aside class="wizard-sidebar">
      <img src="{{ asset('traintracklogo.png') }}" alt="Train Track Logo" class="wizard-logo">
      <h2 class="wizard-title">Progress Guide</h2>

      <div class="wizard-steps">
        <div class="wizard-step">
          <div class="step-circle filled">1</div>
          <div class="step-label">Let’s Get to Know You</div>
        </div>

        <div class="wizard-step">
          <div class="step-circle filled">2</div>
          <div class="step-label">Subject of Interest</div>
          <div class="wizard-substeps">
            <div class="substep">
              <div class="substep-circle">2.1</div>
              <div class="substep-label">Select Interest Categories</div>
            </div>
            <div class="substep">
              <div class="substep-circle">2.2</div>
              <div class="substep-label">Choose Topics</div>
            </div>
          </div>
        </div>

        <div class="wizard-step">
          <div class="step-circle filled">3</div>
          <div class="step-label">Technical Skills</div>
        </div>

        <div class="wizard-step">
          <div class="step-circle filled">4</div>
          <div class="step-label">Non-Technical Skills</div>
        </div>

        <div class="wizard-step">
          <div class="step-circle filled">5</div>
          <div class="step-label">Advance Preferences</div>
        </div>

        <div class="wizard-step">
          <div class="step-circle outlined">6</div>
          <div class="step-label">Summary & Results</div>
        </div>
      </div>
    </aside>

    <!-- 📗 Right Content -->
    <section class="wizard-content">

      <!-- Header -->
      <section class="summary-header">
        <h1>🎯 Summary & Results</h1>
        <p>✨ The right track starts here. ✨</p>
      </section>

      <!-- Recommendation Card -->
      <section class="recommendation-card">
        <h2 class="position-title" id="positionTitle">Loading...</h2>

        <!-- Match Score Bar -->
        <div class="overall-fit">
          <div class="fit-bar">
            <div class="fit-bar-inner" id="fitBar" style="width: 0%;"></div>
          </div>
          <span class="strong-fit-label" id="fitLabel">Loading match...</span>
        </div>

        <!-- Match Circles -->
        <div class="circular-matches">
          <div class="circular-item">
            <div class="circular-progress" id="subjectMatchCircle" data-percentage="0"></div>
            <span class="circular-label">Subject Match</span>
          </div>
          <div class="circular-item">
            <div class="circular-progress" id="technicalSkillCircle" data-percentage="0"></div>
            <span class="circular-label">Technical Skill</span>
          </div>
          <div class="circular-item">
            <div class="circular-progress" id="nonTechnicalSkillCircle" data-percentage="0"></div>
            <span class="circular-label">Non-Technical Skill</span>
          </div>
        </div>

        <!-- Companies Offering This Role -->
        <div class="companies-offering">
          <h3>✨ Companies offering this role:</h3>
          <div id="companyList"></div> <!-- Injected by JS -->
        </div>
      </section>

      <!-- Navigation Buttons -->
      <section class="bottom-buttons">
        <button class="nav-button">My Selections</button>
        <button class="nav-button">Restart Wizard</button>
        <button class="nav-button">Home</button>
        <button class="nav-button">Export PDF</button>
      </section>

    </section>
  </div>

  <!-- JS Link -->
  <script src="{{ asset('js/summary.js') }}"></script>

</body>
</html>
