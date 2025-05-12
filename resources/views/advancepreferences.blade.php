<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Train Track Wizard</title>

  <!-- Fonts & Styles -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/advancepreferences.css') }}">

  <!-- Libraries -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="wizard-body">
  <div class="wizard-layout">

    {{-- ✅ Left Sidebar --}}
    @include('traintrack.partials.sidebar', ['currentStep' => 5])

    {{-- ✅ Right Panel --}}
    <div class="form-area" x-data="advancedPreferences()" x-init="fetchPreferences()">
      <h1 class="form-title">⚙️ Advanced Preferences</h1>
      <p class="form-subtitle">This step’s optional — but it helps us find a match that really fits you.</p>

      <!-- Training Mode -->
      <div class="form-group">
        <h2>Preferred Training Mode</h2>
        <div class="option-grid">
          <template x-for="mode in trainingModes" :key="mode.id">
            <button
              @click="saveTrainingMode(mode.description)"
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
              @click="saveCompanySize(size.description)"
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

      <!-- Buttons -->
      <div class="advanced-buttons">
        <button @click="goBack" class="advanced-btn advanced-btn-back">Back</button>
        <div class="flex gap-4 items-center">
          <button @click="clearAll" class="advanced-btn-clear">Clear</button>
          <button id="skipAndSubmitBtn" class="advanced-btn advanced-btn-skip">Skip</button>
          <button id="submitWithPrefsBtn"
            :disabled="!canSubmit"
            :class="['advanced-btn', 'advanced-btn-submit', { 'opacity-30 pointer-events-none': !canSubmit }]">
            Submit
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- 🔁 Alpine Component -->
  <script>
    function advancedPreferences() {
      return {
        // Loaded from API
        trainingModes: [],
        companySizes: [],
        companyCultures: [],
        industries: [],

        // Selected by user
        training_mode: '',
        company_size: '',
        selected_culture: [],
        selected_industry: [],

        trainingModeTips: {
          onsite: "Training happens at the company's location.",
          remote: "Training can be done from anywhere.",
          hybrid: "Mix of onsite and remote training."
        },

        companySizeTips: {
          small: "Tight-knit teams with flexible roles.",
          medium: "Balanced size with moderate structure.",
          large: "Large companies with formal departments."
        },

        cultureTips: {
          "Creative & Agile": "Innovative and fast-moving teams.",
          "Learning-Focused": "Great for growth and development.",
          "Process-Oriented": "Structured and standardized environment.",
          "Autonomous Workstyle": "Freedom and ownership in your tasks.",
          "Structured Environment": "Clearly defined rules and roles."
        },

<<<<<<< HEAD
        industryTips: {}, // Optional tooltip if you want
=======

<script>
  function advancedPreferences() {
    return {
      trainingModes: [],
      companySizes: [],
      companyCultures: [],
      industries: [],
      training_mode: '',
      company_size: '',
      selected_culture: [],
      selected_industry: [],
>>>>>>> raneen/main

        get canSubmit() {
          return this.selected_industry.length <= 2;
        },

        fetchPreferences() {
          fetch("https://train-track-backend.onrender.com/wizard/preferences")
            .then(res => res.json())
            .then(data => {
              if (data.success) {
                this.trainingModes = data.data.training_modes;
                this.companySizes = data.data.company_sizes;
                this.companyCultures = data.data.company_cultures;
                this.industries = data.data.industries;
              }
            })
            .catch(err => console.error("Failed to load preferences", err));
        },

        toggleCulture(culture) {
          if (this.selected_culture.includes(culture)) {
            this.selected_culture = this.selected_culture.filter(c => c !== culture);
          } else if (this.selected_culture.length < 2) {
            this.selected_culture.push(culture);
          }
          localStorage.setItem("companyCulture", JSON.stringify(this.selected_culture));
        },

        toggleIndustry(industry) {
          if (this.selected_industry.includes(industry)) {
            this.selected_industry = this.selected_industry.filter(i => i !== industry);
          } else if (this.selected_industry.length < 2) {
            this.selected_industry.push(industry);
          }

          const selectedIds = this.selected_industry.map(name => {
            const match = this.industries.find(i => i.name === name);
            return match?.id || null;
          }).filter(Boolean);

          localStorage.setItem("industryIds", JSON.stringify(selectedIds));
        },

        saveTrainingMode(desc) {
          this.training_mode = desc;
          const match = this.trainingModes.find(m => m.description === desc);
          if (match) {
            localStorage.setItem("trainingModeId", match.id);
          }
        },

        saveCompanySize(desc) {
          this.company_size = desc;
          const match = this.companySizes.find(s => s.description === desc);
          if (match) {
            localStorage.setItem("companySizeId", match.id);
          }
        },

        clearAll() {
          this.training_mode = '';
          this.company_size = '';
          this.selected_culture = [];
          this.selected_industry = [];
          localStorage.removeItem("trainingModeId");
          localStorage.removeItem("companySizeId");
          localStorage.removeItem("companyCulture");
          localStorage.removeItem("industryIds");
        },

        goBack() {
          window.history.back();
        }
      }
    }
  </script>

  <!-- JS Submit Logic -->
  <script src="{{ asset('js/advancepreferences.js') }}"></script>
</body>
</html>
