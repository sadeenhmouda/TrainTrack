<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Position Details</title>
  <link rel="stylesheet" href="{{ asset('css/position-details.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
  <!-- ✅ Loader Box - Matching Final Selections Style -->
  <div id="loadingBox">
    <div class="text-purple-700 text-lg font-medium animate-pulse flex items-center gap-2">
      ⏳ <span>Loading your selections...</span>
    </div>
  </div>

  <!-- ✅ Main Page Content (Hidden Initially) -->
  <div class="page-container" style="display: none;">
    <!-- ✅ Logo + Title -->
    <div class="header-stack">
      <a href="{{ url('/') }}">
        <img src="{{ asset('traintracklogo.png') }}" alt="Train Track Logo" class="logo" />
      </a>
      <h1 class="page-heading"> 📋 Position Details</h1>
    </div>

    <!-- ✅ Info Sections -->
    <div class="info-card">
      <h2>📌 <span class="label">Position Name</span> <span id="positionName" class="value"></span></h2>
    </div>

    <div class="info-card">
      <h2>📝 Description</h2>
      <p id="description"></p>
    </div>

    <div class="info-card">
      <h2>📚 Resources</h2>
      <ul id="resources"></ul>
    </div>

    <div class="info-card">
      <h2>🛠️ Tasks</h2>
      <ol id="tasks"></ol>
    </div>

    <div class="info-card">
      <h2>💡 Tips</h2>
      <p id="tips"></p>
    </div>

    <!-- ✅ Back Button -->
    <a href="{{ route('traintrack.summaryresults') }}" class="back-button">
      <span class="arrow-icon">←</span> Back to Results
    </a>
  </div>

  <!-- ✅ JS -->
  <script src="{{ asset('js/position-details.js') }}"></script>
</body>
</html>
