
<!DOCTYPE html>
<html lang="en">
<head> 
 <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  <meta charset="UTF-8" />
  <title>Train Track Wizard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen w-screen bg-white overflow-y-auto font-[Roboto]">
  <!-- Frame Container -->
  <!-- Main Wizard Layout -->
  <div class="w-full  h-full flex bg-white">

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
              <div class="w-8 h-8 rounded-full bg-[#6A1B9A] border-[2px] border-[#6A1B9A]  flex items-center justify-center text-white font font-medium text-sm mr-3">1</div>
              <div class="mt-1 text[13px] text-[#333] font-medium">Let’s Get to Know You</div>
            </div>

            <!-- Step 2 -->
            <div class="flex items-start relative">
              <div class="w-8 h-8 rounded-full bg-[#6A1B9A] border-[2px] border-[#6A1B9A]  flex items-center justify-center text-white font font-medium text-sm mr-3">2</div>
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
              <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border-[2px] border-[#6A1B9A]  flex items-center justify-center text-[#0f0f0f] font-medium text-sm mr-3">3</div>
              <div class="text[13px] text-[#333] font-medium">Technical Skills</div>
            </div>
            <div class="flex items-center relative">
              <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#0f0f0f] font-medium text-sm mr-3">4</div>
              <div class="text[13px] text-[#333] font-medium">Non-Technical Skills</div>
            </div>
            <div class="flex items-center relative">
              <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#0f0f0f] font-medium text-sm mr-3">5</div>
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

 
<!-- Right Side (Technical Skills Step) -->
<div class="flex-1 px-10 py-8 bg-white" x-data="technicalSkillsStep()"> 
  <h1 class="text-[28px] font-medium mb-2">🧠 Technical Skills</h1>
  <p class="text-[15px] text-[#333] ml-2 mb-6">We recommend selecting up to 7 strongest technical skills.</p>

  <!-- Dynamic collapsibles will be inserted here -->
  <div id="skills-container" class="space-y-4 mt-6"></div>

  <!-- Bottom Buttons -->
  <div class="absolute bottom-4 left-0 w-full px-10 flex justify-between items-end"> 
    <!-- Back Button -->
    <a href="{{ route('traintrack.subject2') }}">
      <button
        id="backBtn"
        class="w-[130px] h-[40px] border-2 border-[#6A1B9A] text-[#6A1B9A] text-[25px] font-medium rounded-[12px] transition-all duration-300 mx-80">
        Back
      </button>
    </a>

    <!-- Next Button -->
    <button
      @click="saveAndGoNext()"
      class="w-[130px] h-[40px] bg-[#6A1B9A] text-white text-[20px] font-medium rounded-[12px] hover:bg-[#5a1784] transition duration-300">
      Next
    </button>
  </div>
</div>

<!-- Back Button Toggle Script -->
<script>
  const backBtn = document.getElementById('backBtn');
  backBtn.addEventListener('click', () => {
    backBtn.classList.toggle('bg-[#6A1B9A]');
    backBtn.classList.toggle('text-white');
    backBtn.classList.toggle('border-none');
  });
</script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/alpinejs" defer></script>

<script>
function technicalSkillsStep() {
  return {
    selectedSkills: JSON.parse(localStorage.getItem('selectedTechnicalSkills') || '[]'),

    saveAndGoNext() {
      const checked = document.querySelectorAll('input[name="technical_skills[]"]:checked');
      const skillIds = Array.from(checked).map(el => el.value);

      if (skillIds.length < 1) {
        Swal.fire({
          icon: 'warning',
          title: 'At least one skill required',
          text: 'Please select at least 1 technical skill before continuing.',
          confirmButtonColor: '#6A1B9A',
          confirmButtonText: 'OK',
          customClass: { popup: 'rounded-xl' }
        });
        return;
      }

      localStorage.setItem('selectedTechnicalSkills', JSON.stringify(skillIds));
      window.location.href = '{{ route("traintrack.nontechnical") }}';
    }
  };
}

document.addEventListener('DOMContentLoaded', function () {
  const selectedIds = localStorage.getItem('selectedCategoryIds') || '';
  const selectedSkillIds = JSON.parse(localStorage.getItem('selectedTechnicalSkills') || '[]');

  const emojiMap = {
    "Programming & Logic": "💻",
    "Cloud & DevOps Tools": "☁️",
    "Cybersecurity & IT Security": "🛡️",
    "Security & IT Operations": "🔒",
    "Database Technologies": "🗃️",
    "Web & UI Development": "🌐",
    "Software & System Design": "📐",
    "Testing & QA": "🔍",
    "IT & Business Process Management": "🧠",
    "Marketing Tools & Techniques": "🎯",
    "Digital Marketing Tools": "📢",
    "Data Analysis & BI Tools": "📊"
  };

  axios.get(`https://train-track-backend.onrender.com/wizard/technical-skills?category_ids=${selectedIds}`)
    .then(response => {
      const allCategories = response.data.data;
      const container = document.getElementById('skills-container');

      allCategories.forEach(subjectCategory => {
        const subjectWrapper = document.createElement('div');
        subjectWrapper.classList.add('mb-10');
        subjectWrapper.innerHTML = `<h2 class="text-[22px] font-semibold text-[#333] mb-4">${subjectCategory.Subject_category_name}</h2>`;

        subjectCategory.tech_categories.forEach(techCategory => {
          const emoji = emojiMap[techCategory.tech_category_name] || "📂";
          const wrapper = document.createElement('div');
          wrapper.setAttribute('x-data', '{ open: false }');

          const skillsHTML = techCategory.skills.map(skill => {
            const checked = selectedSkillIds.includes(String(skill.id)) ? 'checked' : '';
            return `
              <label class="flex items-center gap-2 text-[#333] text-sm">
                <input type="checkbox" name="technical_skills[]" value="${skill.id}" ${checked}
                       class="form-checkbox h-4 w-4 text-purple-600 rounded border border-gray-400">
                ${skill.name}
              </label>`;
          }).join('');

          wrapper.innerHTML = `
            <div class="rounded-2xl bg-[#f2dfff] p-1">
              <button @click="open = !open"
                      class="w-full flex justify-between items-center px-6 py-4 rounded-[16px] bg-[#e8d4f8] hover:bg-[#e1c4f6] transition shadow">
                <div class="flex items-center gap-3 text-[#333] font-medium text-[16px]">
                  <span class="text-[20px]">${emoji}</span>
                  ${techCategory.tech_category_name}
                </div>
                <span class="text-[22px] font-bold text-[#6A1B9A]" x-text="open ? '-' : '+'"></span>
              </button>
              <div x-show="open" x-transition class="mt-3 px-6 pb-3 space-y-2">
                ${skillsHTML}
              </div>
            </div>`;

          subjectWrapper.appendChild(wrapper);
        });

        container.appendChild(subjectWrapper);
      });
    })
    .catch(error => {
      console.error('API Error:', error);
      document.getElementById('skills-container').innerHTML = `
        <p class="text-red-600">❌ Failed to load skills. Please try again.</p>`;
    });
});
</script>





      





  </div>
</body>
</html>
