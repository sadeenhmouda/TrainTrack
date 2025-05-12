<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Train Track Wizard – Non-Technical Skills</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<<<<<<< HEAD
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/nontechnicalskills.css') }}">
</head>

<body class="wizard-body">
  <div class="wizard-layout">

    <!-- Sidebar -->
    @include('traintrack.partials.sidebar', ['currentStep' => 4])

    <!-- Right Panel -->
    <div class="right-panel" x-data="nonTechnicalSkillsStep()">

      <!-- Titles -->
      <h1 class="section-title">💬 Non-Technical Skills</h1>
      <p class="section-subtitle">Choose 3 to 5 soft skills you feel most confident in.</p>

      <!-- Counter -->
      <div id="nontech-counter" class="nontech-counter">Selected: 0</div>

      <!-- Skills Grid -->
      <div id="skills-container" class="skills-grid"></div>

      <!-- Navigation Buttons -->
      <div class="wizard-buttons">
        <a href="{{ route('traintrack.technical') }}">
          <button class="btn-outline">Back</button>
        </a>
        <button id="nextBtn" class="btn-next" disabled>Next</button>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <script src="{{ asset('js/non.v2.js') }}"></script>
=======
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <link rel="stylesheet" href="{{ asset('css/nontechnicalskills.css') }}">
</head>

<body class="h-screen w-screen bg-[#f0f0f0] font-[Roboto]">
  <!-- Main Layout -->
  <div class="w-full max-w-screen-2xl mx-auto h-full flex bg-white overflow-hidden">

    <!-- Left Sidebar -->
    <div class="w-[320px] px-6 py-8 bg-white border-r border-[#e0e0e0]">
      <img src="{{ asset('traintracklogo.png') }}" style="width: 180px;" class="fixed top-0 left-0 ml-1 mt-2">
      <div class="mt-[90px]">
        <h3 class="text-[18px] font-normal text-[#333] mb-4">Progress Guide</h3>
        <div class="relative pl-4">
          <div class="absolute top-0 bottom-0 left-[32px] w-[1px] bg-gray-300 z-0"></div>
          <div class="flex flex-col space-y-3 relative z-10">
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-[#6A1B9A] flex items-center justify-center text-white font-semibold text-sm mr-3">1</div>
              <div class="text-[16px] text-[#333] font-medium">Let’s Get to Know You</div>
            </div>
            <div class="flex items-start">
              <div class="w-8 h-8 rounded-full bg-[#6A1B9A] flex items-center justify-center text-white font-semibold text-sm mr-3">2</div>
              <div>
                <div class="text-[16px] text-[#333] font-medium">Your Learning Interests</div>
                <div class="mt-3 space-y-2">
                  <div class="flex items-center">
                    <div class="w-[29px] h-[29px] rounded-full bg-[#6A1B9A] flex items-center justify-center">
                      <span class="text-[10px] text-white font-medium">2.1</span>
                    </div>
                    <div class="ml-2 text-[15px] text-[#333]">Select Interest Categories</div>
                  </div>
                  <div class="flex items-center">
                    <div class="w-[29px] h-[29px] rounded-full bg-[#6A1B9A] flex items-center justify-center">
                      <span class="text-[10px] text-white font-medium">2.2</span>
                    </div>
                    <div class="ml-2 text-[15px] text-[#333]">Choose Topics</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-[#6A1B9A] flex items-center justify-center text-white font-medium text-sm mr-3">3</div>
              <div class="text-[16px] text-[#333] font-medium">Technical Skills</div>
            </div>
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border-2 border-[#6A1B9A] flex items-center justify-center text-[#757575] font-medium text-sm mr-3">3</div>
              <div class="text-[16px] text-[#333] font-medium">Non-Technical Skills</div>
            </div>
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#757575] font-medium text-sm mr-3">4</div>
              <div class="text-[16px] text-[#333] font-medium">Advance Preferences</div>
            </div>
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#757575] font-medium text-sm mr-3">6</div>
              <div class="text-[16px] text-[#333] font-medium">Summary & Results</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Side (Scrollable) -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden" x-data="nonTechnicalSkillsStep()">
      <!-- Scrollable Content -->
      <div class="flex-1 overflow-y-auto px-10 py-6 bg-white">
        <h1 class="text-[28px] font-medium mb-2">💬 Non-Technical Skills</h1>
        <p class="text-[15px] text-[#333] ml-2 mb-1">Choose 2 min soft skills you feel most confident in.</p>
        <div class="selection-counter pr-8 text-right font-medium text-[#6A1B9A]">Selected 0/5</div>
        <div id="skills-container" class="grid grid-cols-2 gap-5 px-4 mt-6"></div>
      </div>

      <!-- Sticky Footer Buttons -->
      <div class="sticky bottom-0 left-0 w-full px-10 py-5 border-t bg-white flex justify-between">
        <a href="/traintrack/technical">
          <button class="advanced-btn advanced-btn-back">Back</button>
        </a>
        <button @click="saveAndGoNext()" class="advanced-btn advanced-btn-next">Next</button>
      </div>
    </div>
  </div>

  <!-- Logic -->
  <script>
    function nonTechnicalSkillsStep() {
      return {
        selectedSkills: JSON.parse(localStorage.getItem('selectedNonTechSkills'))?.skills || [],

        saveAndGoNext() {
          if (this.selectedSkills.length < 2) {
            Swal.fire({
              icon: 'warning',
              title: '⚠️ Minimum Required',
              text: 'Please select at least 2 skills to proceed.',
              confirmButtonColor: '#6A1B9A'
            });
            return;
          }

          localStorage.setItem('selectedNonTechSkills', JSON.stringify({
            skills: this.selectedSkills
          }));

          window.location.href = "{{ route('traintrack.advancepreferences') }}";
        }
      };
    }

    document.addEventListener('DOMContentLoaded', function () {
      const selectedSkillObj = JSON.parse(localStorage.getItem('selectedNonTechSkills') || '{}');
      const selectedSkillIds = selectedSkillObj.skills || [];
      const container = document.getElementById('skills-container');

      const emojiMap = {
        "Effective Communication": "💬",
        "Leadership": "📋",
        "Teamwork": "🤝",
        "Problem-Solving": "💻",
        "Time Management": "⏳",
        "Detailed oriented": "👀",
        "Critical Thinking": "🎯",
        "Creativity": "🎨",
        "User-Centered Thinking": "🧍",
        "Organizational Skills": "📁",
        "Typing Speed & Accuracy": "⌨️",
        "Strategic Thinking": "♟️",
        "Customer Service": "🎧",
        "Adaptability": "🌊",
        "Presentation Skills": "📽️",
        "Collaboration": "🤝"
      };

      axios.get("https://train-track-backend.onrender.com/wizard/non-technical-skills")
        .then(response => {
          const skills = response.data.data;
          skills.forEach(skill => {
            const isChecked = selectedSkillIds.includes(String(skill.id));
            const emoji = emojiMap[skill.name] || '';

            const label = document.createElement('label');
            label.className = 'skill-card';
            label.innerHTML = `
              <input type="checkbox" value="${skill.id}" ${isChecked ? 'checked' : ''}>
              <span>${emoji} ${skill.name}</span>
            `;

            const checkbox = label.querySelector('input');
            checkbox.addEventListener('change', (e) => {
              const id = e.target.value;
              if (e.target.checked) {
                if (selectedSkillIds.length >= 5) {
                  e.target.checked = false;
                  Swal.fire({
                    icon: 'info',
                    title: 'Limit Reached',
                    text: 'You can only choose up to 5 skills.',
                    confirmButtonColor: '#6A1B9A'
                  });
                  return;
                }
                selectedSkillIds.push(id);
              } else {
                const index = selectedSkillIds.indexOf(id);
                if (index !== -1) selectedSkillIds.splice(index, 1);
              }

              localStorage.setItem('selectedNonTechSkills', JSON.stringify({ skills: selectedSkillIds }));
              document.querySelector('.selection-counter').textContent = `Selected ${selectedSkillIds.length}/5`;
            });

            container.appendChild(label);
          });

          document.querySelector('.selection-counter').textContent = `Selected ${selectedSkillIds.length}/5`;
        })
        .catch(error => {
          console.error("API Error:", error);
          container.innerHTML = `<p class="text-red-600 text-sm">❌ Failed to load skills. Please try again later.</p>`;
        });
    });
  </script>
>>>>>>> raneen/main
</body>
</html>
