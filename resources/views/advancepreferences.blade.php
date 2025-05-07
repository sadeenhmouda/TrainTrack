<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Train Track Wizard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('css/advancepreferences.css') }}">

  </head>
  
<body class="h-screen w-screen bg-[#f0f0f0] font-[Roboto] relative">

  <!-- Main Wizard Layout -->
  <div class="w-full max-w-screen-2xl mx-auto h-full flex bg-white">

 <!-- Left Side (Stepper) -->
<div class="w-[320px] px-6 py-8 bg-white border-r border-[#e0e0e0]">
  <!-- App Logo -->
  <img src="{{ asset('traintracklogo.png') }}" style="width: 180px;" class="fixed top-0 left-0  ml-1">
  <br>
  <br>

 <!-- Stepper Title -->
  <h3 class="w-[238px] h-[24px] text-[18px] font-normal text-[#333] mb-4 ml-10px">Progress Guide</h3>

  <!-- Stepper Container -->
  <div class="relative pl-4">
    <!-- Vertical line -->
    <div class="absolute top-0 bottom-0 left-[32px] w-[1px] bg-gray-300 z-0"></div>


    <div class="flex flex-col space-y-3 relative z-10">

   <!-- Step 1 completed-->
    <div class="flex items-center">
        <div class="w-8 h-8 rounded-full bg-[#6A1B9A] border-[2px] border-[#6A1B9A] flex items-center justify-center text-white font-semibold text-sm mr-3">1</div>
        <div class="text-[16px] text-[#333] font-medium">Let’s Get to Know You</div>
      </div>


    <!-- Step 2 complete-->
    <div class="flex items-start relative">
      <div class="w-8 h-8 rounded-full bg-[#6A1B9A] border-[2px] border-[#6A1B9A] flex items-center justify-center text-white font-semibold text-sm mr-3">2</div>
      <div class="flex flex-col justify-center">
        <div class="text[16px] text-[#333] font-medium">Your Learning Interests</div>

        <!-- Substeps -->
        <div class="mt-3 space-y-2">
          <div class="flex items-center">
            <div class="w-[29px] h-[29px] rounded-full  bg-[#6A1B9A] border-[2px] border-[#6A1B9A] flex items-center justify-center">
              <span class="text-[10px] font-medium text-[#ffffff]">2.1</span>
            </div>
            <div class="ml-2 text-[15px] text-[#333]">Select Interest Categories</div>
          </div>
          <div class="flex items-center">
            <div class="w-[29px] h-[29px] rounded-full bg-[#6A1B9A] border-[2px] border-[#6A1B9A] flex items-center justify-center">
              <span class="text-[10px] font-medium text-[#ffffff]">2.2</span>
            </div>
            <div class="ml-2 text-[15px] text-[#333]">Choose Topics</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Steps 3–6 -->
    <div class="flex items-center relative">
      <div class="w-8 h-8 rounded-full  bg-[#6A1B9A] border-[2px] border-[#6A1B9A] flex items-center justify-center text-[#ffffff] font-medium text-sm mr-3">3</div>
      <div class="text[16px] text-[#333] font-medium">Technical Skills</div>
    </div>

    <div class="flex items-center relative">
      <div class="w-8 h-8 rounded-full  bg-[#6A1B9A] border-[2px] border-[#6A1B9A] flex items-center justify-center text-[#ffffff] font-medium text-sm mr-3">3</div>
      <div class="text[16px] text-[#333] font-medium">Non-Technical Skills</div>
    </div>

    <div class="flex items-center relative">
      <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border-[2px] border-[#6A1B9A]  flex items-center justify-center text-[#757575] font-medium text-sm mr-3">4</div>
    <div class="text[16px] text-[#333] font-medium">Advance Preferences</div>
    </div>

    <div class="flex items-center relative">
      <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#757575] font-medium text-sm mr-3">6</div>
      <div class="text[16px] text-[#333] font-medium">Summary & Results</div>
    </div>
  </div>
</div></div>

<!-- ✅ Final Version of Advanced Preferences Page (Right Side Only) -->
<div x-data="advancedPreferences()" x-init="fetchPreferences()" class="flex-1 bg-white overflow-y-auto p-6 text-[14px] leading-tight">
  <!-- Title -->
  <h1 class="text-[28px] font-medium mb-2">⚙️ Advanced Preferences</h1>
  <p class="text-[15px] text-[#333] ml-2 mb-6">This step’s optional — but it helps us find a match that really fits you.</p>

  <!-- Preferred Training Mode -->
  <div class="mb-6 ml-[20px]">
    <h2 class="text-[16px] font-medium mb-2">Preferred Training Mode</h2>
    <div class="flex gap-4 flex-wrap items-center">
      <template x-for="mode in trainingModes" :key="mode.id">
        <button
          @click="training_mode === mode.description ? training_mode = '' : training_mode = mode.description"
          :class="training_mode === mode.description ? 'bg-[#d1c4e9] border-[#6A1B9A] text-[#6A1B9A]' : 'bg-gray-100 text-[#333] border-gray-300'"
          class="px-4 py-2 rounded-xl border hover:border-[#6A1B9A] transition-all"
          :title="trainingModeTips[mode.description.toLowerCase()] || ''">
          <span x-text="mode.description.charAt(0).toUpperCase() + mode.description.slice(1)"></span>
          <span class='text-xs'> ⓘ </span>
        </button>
      </template>
    </div>
  </div>

  <!-- Preferred Company Size -->
  <div class="mb-6 ml-[20px]">
    <h2 class="text-[16px] font-medium mb-2">Preferred Company Size</h2>
    <div class="flex gap-4 flex-wrap items-center">
      <template x-for="size in companySizes" :key="size.id">
        <button
          @click="company_size === size.description ? company_size = '' : company_size = size.description"
          :class="company_size === size.description ? 'bg-[#d1c4e9] border-[#6A1B9A] text-[#6A1B9A]' : 'bg-gray-100 text-[#333] border-gray-300'"
          class="px-4 py-2 rounded-xl border hover:border-[#6A1B9A] transition-all"
          :title="companySizeTips[size.description.toLowerCase()] || ''">
          <span x-text="size.description"></span>
          <span class='text-xs'> ⓘ </span>
        </button>
      </template>
    </div>
  </div>

  <!-- Preferred Company Culture -->
  <div class="mb-6 ml-[20px]">
    <h2 class="text-[16px] font-medium mb-2">Preferred Company Culture</h2>
    <div class="flex gap-4 flex-wrap items-center">
      <template x-for="culture in companyCultures" :key="culture.id">
        <button
          @click="toggleCulture(culture.name)"
          :class="selected_culture.includes(culture.name) ? 'bg-[#d1c4e9] border-[#6A1B9A] text-[#6A1B9A]' : 'bg-gray-100 text-[#333] border-gray-300'"
          class="px-4 py-2 rounded-xl border hover:border-[#6A1B9A] transition-all"
          :title="cultureTips[culture.name] || ''">
          <span x-text="culture.name"></span>
          <span class='text-xs'> ⓘ </span>
        </button>
      </template>
    </div>
  </div>

  <!-- Preferred Industry -->
  <div class="mb-6 ml-[20px]">
    <h2 class="text-[16px] font-medium mb-2">Preferred Industry</h2>
    <p class="text-sm text-gray-500 mb-2">Choose up to 2 industries you’re most interested in.</p>
    <div class="flex gap-4 flex-wrap items-center">
      <template x-for="industry in industries" :key="industry.id">
        <button
          @click="toggleIndustry(industry.name)"
          :class="selected_industry.includes(industry.name) ? 'bg-[#d1c4e9] border-[#6A1B9A] text-[#6A1B9A]' : 'bg-gray-100 text-[#333] border-gray-300'"
          class="px-4 py-2 rounded-xl border hover:border-[#6A1B9A] transition-all"
          :title="industryTips[industry.name] || ''">
          <span x-text="industry.name"></span>
          <span class='text-xs'> ⓘ </span>
        </button>
      </template>
    </div>
  </div>
<!--navigation buttons and clear-->
<div class="advanced-buttons">
  <button @click="goBack" class="advanced-btn advanced-btn-back">Back</button>

  <div class="flex items-center gap-4">
    <button @click="clearAll" class="advanced-btn-clear">Clear</button>
    <button @click="skip" class="advanced-btn advanced-btn-skip">Skip</button>
    <button @click="submit" 
            :disabled="!canSubmit"
            :class="['advanced-btn', 'advanced-btn-submit', { 'opacity-30 pointer-events-none': !canSubmit }]">
      Submit
    </button>
  </div>
</div>


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

      trainingModeTips: {
        hybrid: "Mix of onsite and remote training.",
        onsite: "Training happens at the company's location.",
        remotely: "Training can be done from anywhere."
      },

      companySizeTips: {
        small: "Tight-knit teams with flexible roles and personal mentoring.",
        medium: "Balanced size with some structure and room to grow.",
        large: "Big companies with structured departments and formal training."
      },

      cultureTips: {
        "Autonomous Workstyle": "Work independently with trust and ownership.",
        "Creative & Agile": "Flexible and innovative environment.",
        "Learning-Focused": "Emphasis on growth and learning.",
        "Process-Oriented": "Structured workflows and standard procedures.",
        "Structured Environment": "Clear rules, responsibilities, and hierarchy."
      },

      industryTips: {
        "Workforce Management": "Managing teams, schedules, and productivity.",
        "Telecommunications": "Working with mobile, internet, and signals.",
        "Insurance": "Risk management and customer protection.",
        "Software Development": "Building and maintaining software systems.",
        "E-commerce Solutions": "Online shopping and retail systems."
      },

      fetchPreferences() {
        fetch("https://train-track-backend.onrender.com/wizard/preferences")
          .then(res => res.json())
          .then(data => {
            this.trainingModes = data.data.training_modes;
            this.companySizes = data.data.company_sizes;
            this.companyCultures = data.data.company_cultures;
            this.industries = data.data.industries;
          });
      },

      toggleCulture(item) {
        if (this.selected_culture.includes(item)) {
          this.selected_culture = this.selected_culture.filter(i => i !== item);
        } else if (this.selected_culture.length < 2) {
          this.selected_culture.push(item);
        }
      },

      toggleIndustry(item) {
        if (this.selected_industry.includes(item)) {
          this.selected_industry = this.selected_industry.filter(i => i !== item);
        } else {
          if (this.selected_industry.length >= 2) {
            this.selected_industry.shift();
          }
          this.selected_industry.push(item);
        }
      },

      clearAll() {
        this.training_mode = '';
        this.company_size = '';
        this.selected_culture = [];
        this.selected_industry = [];
        localStorage.removeItem("preferences");
      },

      get canSubmit() {
        return this.training_mode || this.company_size || this.selected_culture.length > 0 || this.selected_industry.length > 0;
      },

      goBack() {
  const payload = {
    training_mode: this.training_mode,
    preferred_company_size: this.company_size,
    preferred_culture: this.selected_culture,
    preferred_industry: this.selected_industry,
  };
  localStorage.setItem("preferences", JSON.stringify(payload));
  window.location.href = "/traintrack/nontechnical";
},

     
skip() {
  Swal.fire({
    title: 'Redirecting...',
    text: 'Please wait a moment ✨',
    allowOutsideClick: false,
    didOpen: () => Swal.showLoading()
  });

  setTimeout(() => {
    localStorage.setItem("preferences", JSON.stringify({}));
    window.location.href = "/traintrack/summaryresults";
  }, 1000);
},

submit() {
        const payload = {
          training_mode: this.training_mode,
          preferred_company_size: this.company_size,
          preferred_culture: this.selected_culture,
          preferred_industry: this.selected_industry,
        };

        localStorage.setItem("preferences", JSON.stringify(payload));

        Swal.fire({
          title: 'Submitting...',
          text: 'Please wait...',
          allowOutsideClick: false,
          didOpen: () => Swal.showLoading()
        });

        fetch("https://train-track-backend.onrender.com/wizard/preferences", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(payload)
        })
        .then(res => {
          if (res.ok) {
            Swal.fire({
              title: 'Success 🎉',
              text: 'Preferences saved!',
              icon: 'success',
              confirmButtonText: 'Continue'
            }).then(() => {
              window.location.href = "/traintrack/summaryresults";
            });
          } else {
            Swal.fire({
              title: 'Oops!',
              text: 'Something went wrong!',
              icon: 'error',
              confirmButtonText: 'OK'
            });
          }
        })
        .catch(() => {
          Swal.fire({
            title: 'Network Error',
            text: 'Check your internet connection.',
            icon: 'warning',
            confirmButtonText: 'OK'
          });
        });
      }
    }
  }</script>