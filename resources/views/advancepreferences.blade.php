<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Train Track Wizard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="h-screen w-screen bg-[#f0f0f0] font-[Roboto] relative">

  <!-- Main Wizard Layout -->
  <div class="w-full h-full flex bg-white">

    <!-- Left Side (Stepper) -->
    <div class="w-[320px] px-6 py-7 bg-white border-r border-[#e0e0e0]">

      <!-- App Logo -->
      <img src="{{ asset('traintracklogo.png') }}" style="width: 180px;" class="fixed top-0 left-0  ml-1">
      <br>
      <br>

      <!-- Stepper Container -->
      <!-- Stepper Title -->
      <div class="mt-5 ml-4">
        <h3 class="w-[238px] h-[24px] text-[20px] font-normal text-[#333] mb-4 ml-10px">Progress Guide</h3>
        <div class="relative ml-1">

          <!-- Vertical line behind steps -->
          <div class="-ml-6 absolute top-0 bottom-0 left-[32px] w-[1px] bg-gray-300 z-0"></div>

          <div class="flex flex-col space-y-3 relative z-10 -ml-2">
            <!-- Step 1 -->
            <div class="flex items-center relative">
              <div class="w-8 h-8 rounded-full bg-[#6A1B9A] border-[2px] border-[#6A1B9A] flex items-center justify-center text-white font-medium text-sm mr-3">1</div>
              <div class="mt-1 text[13px] text-[#333] font-medium">Let’s Get to Know You</div>
            </div>

            <!-- Step 2 -->
            <div class="flex items-start relative">
              <div class="w-8 h-8 rounded-full bg-[#6A1B9A] border-[2px] border-[#6A1B9A] flex items-center justify-center text-white font-medium text-sm mr-3">2</div>
              <div class="flex flex-col justify-center">
                <div class="mt-1 text[13px] text-[#333] font-medium">Subject of Interest</div>
                <!-- Substeps -->
                <div class="mt-3 space-y-3">
                  <div class="flex items-center">
                    <div class="w-[29px] h-[29px] rounded-full bg-[#6A1B9A] border border-[#6A1B9A] flex items-center justify-center">
                      <span class="text-[12px] font-medium text-white">2.1</span>
                    </div>
                    <div class="ml-2 text-[15px] text-[#333]">Select Interest Categories</div>
                  </div>
                  <div class="flex items-center">
                    <div class="w-[29px] h-[29px] rounded-full bg-[#6A1B9A] border border-[#6A1B9A] flex items-center justify-center">
                      <span class="text-[12px] font-medium text-white">2.2</span>
                    </div>
                    <div class="ml-2 text-[15px] text-[#333]">Choose Topics</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Steps 3–6 -->
            <div class="flex items-center relative">
              <div class="w-8 h-8 rounded-full bg-[#6A1B9A] border-[2px] border-[#6A1B9A] flex items-center justify-center text-white font-medium text-sm mr-3">3</div>
              <div class="text[13px] text-[#333] font-medium">Technical Skills</div>
            </div>
            <div class="flex items-center relative">
              <div class="w-8 h-8 rounded-full bg-[#6A1B9A] border-[2px] border-[#6A1B9A] flex items-center justify-center text-white font-medium text-sm mr-3">4</div>
              <div class="text[13px] text-[#333] font-medium">Non-Technical Skills</div>
            </div>
            <div class="flex items-center relative">
              <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border-[2px] border-[#6A1B9A]  flex items-center justify-center text-[#0f0f0f] font-medium text-sm mr-3">5</div>
              <div class="text[13px] text-[#333] font-medium">Advance Preferences</div>
            </div>
            <div class="flex items-center relative">
              <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#0f0f0f] font-medium text-sm mr-3">6</div>
              <div class="text[13px] text-[#333] font-medium">Summary & Results</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Side (Content) -->
    <div class="flex-1 bg-white overflow-y-auto p-6 text-[14px] leading-tight" x-data="advancedPreferences()" x-init="">

      <!-- Title -->
      <h1 class="text-[26px] font-medium mb-2">⚙️ Advanced Preferences</h1>
      <p class="text-[15px] text-[#333] ml-[40px] mb-6">This step’s optional — but it helps us find a match that really fits you.</p>

      <!-- Preferred Training Mode -->
      <div class="mb-6 ml-[20px]">
        <h2 class="text-[16px] font-medium mb-2">Preferred Training Mode</h2>
        <div class="flex gap-4 flex-wrap items-center">
          <template x-for="mode in ['Onsite', 'Remote', 'Hybrid']" :key="mode">
            <button @click="training_mode = mode"
              :class="training_mode === mode ? 'bg-[#d1c4e9] border-2 border-[#6A1B9A] text-[#6A1B9A]' : 'bg-gray-100 border border-gray-300 text-[#333]'"
              class="px-5 py-2 rounded-full hover:border-[#6A1B9A] transition-all">
              <span x-text="mode"></span>
            </button>
          </template>
          <button @click="training_mode = ''" class="text-sm text-blue-600 hover:underline ml-2">Clear</button>
        </div>
      </div>

      <!-- Preferred Company Size -->
      <div class="mb-6 ml-[20px]">
        <h2 class="text-[16px] font-medium mb-2">Preferred Company Size</h2>
        <div class="flex gap-4 flex-wrap items-center">
          <template x-for="size in companySizeOptions" :key="size.value">
            <button @click="company_size = size.value"
              :class="company_size === size.value ? 'bg-[#d1c4e9] border-2 border-[#6A1B9A] text-[#6A1B9A]' : 'bg-gray-100 border border-gray-300 text-[#333]'"
              class="px-5 py-2 rounded-full hover:border-[#6A1B9A] transition-all"
              :title="size.tip">
              <span x-text="size.label"></span>
            </button>
          </template>
          <button @click="company_size = ''" class="text-sm text-blue-600 hover:underline ml-2">Clear</button>
        </div>
      </div>

      <!-- Preferred Company Culture -->
      <div class="mb-6 ml-[20px]">
        <h2 class="text-[16px] font-medium mb-2">Preferred Company Culture</h2>
        <div class="flex gap-4 flex-wrap items-center">
          <template x-for="culture in companyCultureOptions" :key="culture.name">
            <button @click="toggleCulture(culture.name)"
              :class="selected_culture.includes(culture.name) ? 'bg-[#d1c4e9] border-2 border-[#6A1B9A] text-[#6A1B9A]' : 'bg-gray-100 border border-gray-300 text-[#333]'"
              class="px-5 py-2 rounded-full hover:border-[#6A1B9A] transition-all"
              :title="culture.tip">
              <span x-text="culture.name"></span>
            </button>
          </template>
          <button @click="selected_culture = []" class="text-sm text-blue-600 hover:underline ml-2">Clear</button>
        </div>
      </div>

      <!-- Preferred Industry -->
      <div class="mb-6 ml-[20px]">
        <h2 class="text-[16px] font-medium mb-2">Preferred Industry</h2>
        <div class="flex justify-between items-center mb-2">
          <p class="text-sm text-gray-500">Choose up to 2 industries you’re most interested in.</p>
          <span class="text-sm text-[#6A1B9A]" x-text="`Selected ${selected_industry.length}/2`"></span>
        </div>
        <div class="flex gap-4 flex-wrap items-center">
          <template x-for="industry in industryOptions" :key="industry.name">
            <button @click="toggleIndustry(industry.name)"
              :class="selected_industry.includes(industry.name) ? 'bg-[#d1c4e9] border-2 border-[#6A1B9A] text-[#6A1B9A]' : 'bg-gray-100 border border-gray-300 text-[#333]'"
              class="px-5 py-2 rounded-full hover:border-[#6A1B9A] transition-all"
              :title="industry.tip">
              <span x-text="industry.emoji + ' ' + industry.name"></span>
            </button>
          </template>
          <button @click="selected_industry = []" class="text-sm text-blue-600 hover:underline ml-2">Clear</button>
        </div>
      </div>

      <!-- Navigation Buttons -->
      <div class="absolute bottom-4 left-0 w-full px-10 flex justify-between items-end">
        <button @click="saveAndGoBack"
          class="w-[130px] h-[47px] rounded-[12px] border-2 border-[#6A1B9A] text-[#6A1B9A] text-[20px] font-medium hover:bg-[#f3e5f5] transition duration-300 mx-80">
          Back
        </button>

        <div class="flex gap-4">
          <button @click="skip"
            class="w-[130px] h-[47px] rounded-[12px] bg-gray-400 text-white text-[20px] font-medium hover:bg-gray-500 transition duration-300">
            Skip
          </button>

          <button @click="submit"
            :disabled="!canSubmit"
            :class="canSubmit ? 'bg-[#6A1B9A] text-white hover:bg-[#5a1584]' : 'bg-[#6A1B9A] text-white opacity-30 pointer-events-none'"
            class="w-[130px] h-[47px] rounded-[12px] text-[20px] font-medium transition duration-300">
            Submit
          </button>
        </div>
      </div>

    </div>

  </div>

<script>
  function advancedPreferences() {
  return {
    training_mode: '',
    company_size: '',
    selected_culture: [],
    selected_industry: [],

    companySizeOptions: [
      { label: '👨‍💼 Small', value: 'Small', tip: 'Tight-knit teams with flexible roles and personal mentoring.' },
      { label: '👥 Medium', value: 'Medium', tip: 'Balanced size with some structure and room to grow.' },
      { label: '🏢 Large', value: 'Large', tip: 'Big companies with structured departments and formal training.' }
    ],

    companyCultureOptions: [
      { name: 'Horizontal Experience', tip: 'Flat teams where everyone shares ideas equally — fewer managers.' },
      { name: 'Vertical Experience', tip: 'Structured teams with clear roles and reporting — more supervision.' }
    ],

    industryOptions: [
      { name: "Workforce Management", emoji: "👔", tip: "Managing teams, schedules, and productivity." },
      { name: "Telecommunications", emoji: "📡", tip: "Mobile, internet, and networks." },
      { name: "Insurance", emoji: "🛡️", tip: "Protection and risk management." },
      { name: "Software Development", emoji: "💻", tip: "Programming and apps." },
      { name: "E-commerce", emoji: "🛍️", tip: "Online retail platforms." }
    ],

    toggleCulture(item) {
      this.selected_culture.includes(item)
        ? this.selected_culture = this.selected_culture.filter(i => i !== item)
        : this.selected_culture.length < 2 && this.selected_culture.push(item);
    },

    toggleIndustry(item) {
      this.selected_industry.includes(item)
        ? this.selected_industry = this.selected_industry.filter(i => i !== item)
        : this.selected_industry.length < 2 && this.selected_industry.push(item);
    },
    get canSubmit() {
      return this.training_mode || this.company_size || this.selected_culture.length > 0 || this.selected_industry.length > 0;
    },

    // New to control Skip button visibility
    get hasSelected() {
      return this.training_mode || this.company_size || this.selected_culture.length > 0 || this.selected_industry.length > 0;
    },

    saveAndGoBack() {
      const payload = {
        training_mode: this.training_mode,
        preferred_company_size: this.company_size,
        preferred_culture: this.selected_culture,
        preferred_industry: this.selected_industry,
      };
      localStorage.setItem('preferences', JSON.stringify(payload));
      window.location.href = "/traintrack/technical"; // <<< Now go to technical page
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
      }, 1000); // simulate a short loading
    },

    submit() {
      const payload = {
        training_mode: this.training_mode,
        preferred_company_size: this.company_size,
        preferred_culture: this.selected_culture,
        preferred_industry: this.selected_industry,
      };

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
  };
}
</script>

</body>
</html>
