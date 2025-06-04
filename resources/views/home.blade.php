<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Train Track - Landing Page</title>

  {{-- Google Font --}}
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

  {{-- Link to CSS file --}}
  <link rel="stylesheet" href="{{ asset('css/home.css') }}" />

  {{-- Link to JS file --}}
  <script src="{{ asset('js/home.js') }}" defer></script>
</head>
<body>

  <!-- ✅ Navbar -->
  <nav class="navbar">
    <!-- Logo -->
    <div class="logo">
      <a href="/">
        <img src="{{ asset('traintrack2.png') }}" alt="TrainTrack Logo" class="logo-img">
      </a>
    </div>

    <!-- Right Side -->
    <div class="navbar-right">
      <div class="nav-links">
        
        <div class="dropdown">
          <button class="dropdown-btn" onclick="toggleDropdown()">Track ▼</button>
          <div id="trackDropdown" class="dropdown-content">
            <a href="#">CV Preparation</a>
            <a href="#">LinkedIn Optimization</a>
            <a href="#">Tutorials</a>
          </div>
        </div>
        <a href="#">About Us</a>
        <a href="#">Contact Us</a>
      </div>

      <div class="auth-buttons">
        <a href="/signup" class="signup-link">Sign up</a>
        <a href="/login" class="login-btn">Log in</a>
      </div>
    </div>
  </nav>

  <!-- ✅ Hero Section -->
  <section class="hero">
    <div class="overlay"></div> 
    <!-- Hero Text Content -->
    <div class="hero-content">
      <h2>The Fast Track<br> to Your Perfect Internship</h2>
      <p>On the right track to your perfect internship – smart matching for career success.</p>
      <a href="{{ route('traintrack.start') }}" class="cta-button" onclick="resetWizard()">Try TrainTrack Now</a>
       <div class="image-tint"></div>
    </div>

    <!-- Hero Decorative Image (Bottom Right) -->
    <img src="{{ asset('remove1.png') }}" alt="Decorative Path" class="hero-decor-image">
  </section>

  <!-- ✅ Script placed at the end of body for best practice -->
 <script>
  function resetWizard() {
    const keys = [
      "fullName", "gender", "majorId", "dateOfBirth",
      "selectedSubjectIds", "selectedSubjectCategoryIds", // ✅ ADD THIS LINE
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
</script>
</body>
</html>
