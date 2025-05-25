<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>{{ $company['company_name'] }} | Company Details</title>
  <link rel="stylesheet" href="{{ asset('css/companydetails.css') }}">
</head>
<body>
  <div class="page-container fade-in">
 <!-- ✅ Loader Box - Matching Final Selections Style -->
  <div id="loadingBox">
    <div class="text-purple-700 text-lg font-medium animate-pulse flex items-center gap-2">
      ⏳ <span>Loading your selections...</span>
    </div>
  </div>

    <!-- ✅ Main Content -->
    <div id="mainContent" style="display: none;">

      <!-- 🔰 Logo + Title -->
      <div class="header-stack">
        <a href="{{ url('/') }}">
          <img src="{{ asset('traintracklogo.png') }}" alt="Train Track Logo" class="logo" />
        </a>
        <h1 class="page-heading"> 📋 Company Details</h1>
      </div>

      <!-- 🖼️ Company Logo + Summary -->
      <div class="info-card logo-card">
        <img
          src="{{ asset('static/logos/' . strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $company['company_name'])) . '.png') }}"
          onerror="this.onerror=null;this.src='{{ asset('static/logos/company-placeholder.png') }}';"
          alt="Company Logo"
          class="company-logo"
        >
        <div>
          <h2 class="company-name">{{ $company['company_name'] }}</h2>
          <p class="company-description">{{ $company['description'] }}</p>
        </div>
      </div>

      <!-- 🧾 Info -->
      <div class="info-card">
        <h2>📄 Company Information</h2>
        <ul class="info-list">
          <li><span>📦 Industry:</span> {{ $company['industry'] }}</li>
          @if(!empty($company['main_branch']))
            <li><span>🌍 Location:</span> {{ $company['main_branch']['city'] ?? '-' }}, {{ $company['main_branch']['country'] ?? '-' }}</li>
            <li><span>📍 Address:</span> {{ $company['main_branch']['address'] ?? '-' }}</li>
          @endif
          <li><span>🏢 Company Size:</span> {{ $company['company_size'] }}</li>
          <li><span>🧭 Training Mode:</span> {{ $company['training_mode'] }}</li>
          <li><span>⏱️ Training Hours:</span> {{ $company['training_hours'] }} hrs</li>
          <li><span>🏬 Branches:</span> {{ $company['branch_count'] }}</li>
          <li><span>🎯 Culture:</span> {{ $company['culture_keywords'] }}</li>
          @if(!empty($company['main_branch']['website_link']))
            <li><span>🌐 Website:</span> <a href="{{ $company['main_branch']['website_link'] }}" target="_blank">Visit Company Website</a></li>
          @endif
        </ul>
      </div>

      <!-- 💼 Training Positions -->
      <div class="info-card">
        <h2>🚀 Training Positions Offered</h2>
        <ul class="position-list">
          @foreach($company['positions'] as $position)
            <li>💼 {{ $position['name'] }}</li>
          @endforeach
        </ul>
      </div>

      <a href="/traintrack/summaryresults" class="back-button">
        <span class="arrow-icon">←</span> Back to My Results
      </a>
    </div>
  </div>

  <!-- ✅ Show content once loaded -->
 <script>
  document.addEventListener("DOMContentLoaded", function () {
    const loading = document.getElementById("loadingBox");
    const content = document.getElementById("mainContent");

    // ✅ Add delay so loader appears briefly
    setTimeout(() => {
      loading.style.display = "none";
      content.style.display = "block";
    }, 500); // Adjust delay in ms (e.g., 500 = 0.5s)
  });
</script>


  <script src="{{ asset('js/companydetails.js') }}"></script>
</body>
</html>
