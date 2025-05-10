<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Train Track Wizard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/advancepreferences.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="wizard-body">
  <div class="wizard-layout">
    {{-- ✅ Left Sidebar --}}
    @include('traintrack.partials.sidebar', ['currentStep' => 5])

    {{-- ✅ Right Side: Advanced Preferences --}}
    <div class="form-area" x-data="advancedPreferences()" x-init="fetchPreferences()">
      <h1 class="form-title">⚙️ Advanced Preferences</h1>
      <p class="form-subtitle">This step’s optional — but it helps us find a match that really fits you.</p>

      <!-- Training Mode -->
      <div class="form-group">
        <h2>Preferred Training Mode</h2>
        <div class="option-grid">
          <template x-for="mode in trainingModes" :key="mode.id">
            <button
              @click="training_mode === mode.description ? training_mode = '' : training_mode = mode.description"
              :class="training_mode === mode.description ? 'selected-option' : 'default-option'"
              :title="trainingModeTips[mode.description.toLowerCase()] || ''">
              <span x-text="mode.description"></span> ⓘ
            </button>
          </template>
        </div>
      </div>

      <!-- Company Size -->
      <div class="form-group">
        <h2>Preferred Company Size</h2>
        <div class="option-grid">
          <template x-for="size in companySizes" :key="size.id">
            <button
              @click="company_size === size.description ? company_size = '' : company_size = size.description"
              :class="company_size === size.description ? 'selected-option' : 'default-option'"
              :title="companySizeTips[size.description.toLowerCase()] || ''">
              <span x-text="size.description"></span> ⓘ
            </button>
          </template>
        </div>
      </div>

      <!-- Company Culture -->
      <div class="form-group">
        <h2>Preferred Company Culture</h2>
        <div class="option-grid">
          <template x-for="culture in companyCultures" :key="culture.id">
            <button
              @click="toggleCulture(culture.name)"
              :class="selected_culture.includes(culture.name) ? 'selected-option' : 'default-option'"
              :title="cultureTips[culture.name] || ''">
              <span x-text="culture.name"></span> ⓘ
            </button>
          </template>
        </div>
      </div>

      <!-- Industry -->
      <div class="form-group">
        <h2>Preferred Industry</h2>
        <p class="note">Choose up to 2 industries you’re most interested in.</p>
        <div class="option-grid">
          <template x-for="industry in industries" :key="industry.id">
            <button
              @click="toggleIndustry(industry.name)"
              :class="selected_industry.includes(industry.name) ? 'selected-option' : 'default-option'"
              :title="industryTips[industry.name] || ''">
              <span x-text="industry.name"></span> ⓘ
            </button>
          </template>
        </div>
      </div>

      <!-- Navigation Buttons -->
      <div class="advanced-buttons">
        <button @click="goBack" class="advanced-btn advanced-btn-back">Back</button>
        <div class="flex gap-4 items-center">
          <button @click="clearAll" class="advanced-btn-clear">Clear</button>
          <button @click="skip" class="advanced-btn advanced-btn-skip">Skip</button>
          <button @click="submit"
            :disabled="!canSubmit"
            :class="['advanced-btn', 'advanced-btn-submit', { 'opacity-30 pointer-events-none': !canSubmit }]">
            Submit
          </button>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/advancepreferences.js') }}"></script>
</body>
</html>
