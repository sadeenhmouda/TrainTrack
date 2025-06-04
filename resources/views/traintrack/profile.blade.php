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
      <a href="/" class="logo-wordmark">
        <span class="logo-part purple">Train</span><span class="logo-part orange">Track</span>
      </a>
      <nav class="center-nav">
        <a href="/">Home</a>
        <div class="dropdown">
          <a href="#" class="dropdown-btn" onclick="toggleDropdown()">Track ▼</a>
          <div id="trackDropdown" class="dropdown-content">
            <a href="#">CV Preparation</a>
            <a href="#">LinkedIn Optimization</a>
            <a href="#">Tutorials</a>
          </div>
        </div>
        <a href="#">About Us</a>
        <a href="/profile" class="active">Profile</a>
      </nav>
    </div>
    <div class="right-section">
      <a href="#" id="logoutBtn" class="logout-btn">Logout</a>
    </div>
  </header>

  <div class="dashboard-wrapper">
    <!-- ✅ User Header Section -->
    <div class="profile-banner">
      <div id="welcomeBanner" class="welcome-banner">
        <div class="welcome-content">
          👋 Welcome to your dashboard, <span id="welcomeName">Friend</span>!
        </div>
      </div>
      <div class="circle-avatar" id="avatarCircle">G</div>
      <div class="user-details">
        <h2 id="profileName"> Guest</h2>
        <p></p>
        <div class="action-buttons">
          <button class="btn-primary">✏️ Edit Profile</button>
          <button class="btn-primary" id="startNewTrialBtn">🚀 Start New Trial</button>
        </div>
      </div>
    </div>

    <!-- ✅ Recent Trails Section -->
    <section class="recent-trails">
      <div class="dashboard-header">
        <h3>Recent Trials</h3>
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
    localStorage.clear();
  </script>
  @endif

  <script src="{{ asset('js/profile.js') }}"></script>
  <script>
  // ✅ This code runs when the page loads
  document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const userIdFromUrl = urlParams.get("user_id");

    if (userIdFromUrl) {
      // ✅ Store the user ID in localStorage so we can use it later
      localStorage.setItem("userId", userIdFromUrl);

      // ✅ Remove the user_id from the URL (cleaner look)
      window.history.replaceState({}, document.title, window.location.pathname);
    }
  });
</script>

</body>
</html>
