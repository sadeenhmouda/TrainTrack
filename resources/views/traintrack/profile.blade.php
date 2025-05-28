<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Train Track | Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
  <!-- ✅ Modern Profile Header -->
<header class="dribbble-navbar">
  <div class="left-combined">
<div class="logo-wordmark">
  <span class="logo-part purple">Train</span><span class="logo-part orange">Track</span>
</div>
    <nav class="center-nav">
      <a href="/">Home</a>
      <a href="/traintrack">Wizard</a>
      <a href="/profile" class="active">Profile</a>
    </nav>
  </div>

  <div class="right-section">
    <a href="/logout" class="logout-btn">Logout</a>
  </div>
</header>
  <div class="dashboard-wrapper">
    <!-- ✅ User Header Section -->
    <div class="profile-banner">
      <div id="welcomeBanner" class="welcome-banner" style="display: none;">
        <div class="welcome-content">
          👋 Welcome to your dashboard, <span id="welcomeName">Friend</span>!
        </div>
      </div>
      <div class="circle-avatar" id="avatarCircle">G</div>
      <div class="user-details">
        <h2 id="profileName">Graduation Project </h2>
        <p>Nablus, Palestinian Territory</p>
        <div class="action-buttons">
          <button class="btn-primary">✏️ Edit Profile</button>
          <button class="btn-primary" id="startNewTrialBtn">🚀 Start New Trial</button>
        </div>
      </div>
    </div>

    <!-- ✅ Recent Trails Section -->
    <section class="recent-trails">
      <div class="dashboard-header">
        <h3>Recent Trails</h3>
        <select id="sortTrials" class="filter-dropdown">
          <option value="latest">Newest First</option>
          <option value="oldest">Oldest First</option>
          <option value="updated">Recently Updated</option>
        </select>
      </div>
      <div id="trailContainer" class="trail-cards">
        <!-- JS will inject trail cards here -->
      </div>
    </section>
  </div>
@if(session('clearLocalStorage'))
<script>
  localStorage.clear(); // or just specific keys as above
</script>
@endif

  <script src="{{ asset('js/profile.js') }}"></script>
</body>
</html>
