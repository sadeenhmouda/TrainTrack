<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Train Track - Landing Page</title>

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/home.css') }}" />

  <!-- JS -->
  <script src="{{ asset('js/home.js') }}" defer></script>
</head>
<body>

<!-- ✅ FIXED Modern Header (profile-style) -->
<header class="dribbble-navbar">
  <div class="left-combined">
    <a href="/" class="logo-wordmark">
      <span class="logo-part purple">Train</span><span class="logo-part orange">Track</span>
    </a>
    <nav class="center-nav">
      <a href="/" class="active">Home</a>
      <div class="dropdown">
        <a href="#" class="dropdown-btn" onclick="toggleDropdown()">Track ▼</a>
        <div id="trackDropdown" class="dropdown-content">
          <a href="#">CV Preparation</a>
          <a href="#">LinkedIn Optimization</a>
          <a href="#">Tutorials</a>
        </div>
      </div>
      <a href="#">About Us</a>
      <a href="/profile">Profile</a> <!-- ✅ Replaces Contact Us -->
    </nav>
  </div>
  <div class="right-section">
    <a href="/signup" class="btn-filled">Sign Up</a>
    <a href="/login" class="btn-outline">Log In</a>
  </div>
</header>

<!-- ✅ Hero Section (unchanged layout) -->
<section class="hero">
  <div class="overlay"></div>
  <div class="hero-content">
    <h2>The Fast Track<br> to Your Perfect Internship</h2>
    <p>On the right track to your perfect internship – smart matching for career success.</p>
    <a href="{{ route('traintrack.start') }}" class="cta-button" onclick="resetWizard()">Try Train Track Now</a>
    <div class="image-tint"></div>
  </div>

  <img src="{{ asset('remove1.png') }}" alt="Decorative Path" class="hero-decor-image">
</section>

<!-- ✅ Script -->
<script>
  function resetWizard() {
    const keys = [
      "fullName", "gender", "majorId", "dateOfBirth",
      "selectedSubjectIds", "selectedSubjectCategoryIds",
      "selectedTechnicalSkills", "selectedNonTechnicalSkills",
      "trainingModeId", "trainingModeDesc", "companySizeId", "companySizeDesc",
      "industryIds", "selectedIndustryNames", "companyCulture", "cultureMap",
      "recommendationResult", "fallbackTriggered", "finalWizardData",
      "wizard_selections", "subject_categories", "technical_skills",
      "non_technical_skills", "advanced_preferences", "fallback_state"
    ];
    keys.forEach(k => localStorage.removeItem(k));
    console.log("🧹 Wizard reset: localStorage keys cleared");
  }

  function toggleDropdown() {
    document.getElementById("trackDropdown").classList.toggle("show");
  }

  window.onclick = function(e) {
    if (!e.target.matches('.dropdown-btn')) {
      var dropdown = document.getElementById("trackDropdown");
      if (dropdown && dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
      }
    }
  };
</script>

</body>
</html>
