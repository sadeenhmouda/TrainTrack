
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Train Track Wizard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/nontechnicalskills.css') }}">

</head>
<body class="h-screen w-screen bg-[#f0f0f0] font-[Roboto] relative">

  <!-- Frame Container -->
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
      <div class="w-8 h-8 rounded-full  bg-[#F5F5F5] border-[2px] border-[#6A1B9A] flex items-center justify-center text-[#757575] font-medium text-sm mr-3">3</div>
      <div class="text[16px] text-[#333] font-medium">Non-Technical Skills</div>
    </div>

    <div class="flex items-center relative">
      <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border-[2px]  border-gray-300  flex items-center justify-center text-[#757575] font-medium text-sm mr-3">4</div>
    <div class="text[16px] text-[#333] font-medium">Advance Preferences</div>
    </div>

    <div class="flex items-center relative">
      <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#757575] font-medium text-sm mr-3">6</div>
      <div class="text[16px] text-[#333] font-medium">Summary & Results</div>
    </div>
  </div>
</div></div>
     <!-- Right Side (New Section) -->
     <!-- Right Side (Non-Technical Skills Step) -->
<div class="flex-1 px-10 py-8 bg-white" x-data="nonTechnicalSkillsStep()">
  <h1 class="text-[28px] font-medium mb-2">💬 Non-Technical Skills</h1>
  <p class="text-[15px] text-[#333] ml-2 mb-1">Choose 2 min soft skills you feel most confident in.</p>
<div class="selection-counter pr-8" x-text="'Selected ' + selectedSkills.length + '/5'"></div>

  <!-- Dynamic skills will be inserted here -->
  <div id="skills-container" class="grid grid-cols-2 gap-5 px-4 mt-6"></div>

  <!-- Bottom Buttons -->
  <div class="absolute bottom-4 left-0 w-full px-10 flex justify-between items-end">
    <!-- Back Button -->
    <a href="{{ route('traintrack.technical') }}">
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

// Load skills dynamically when the page is ready
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
  })
  .catch(error => {
    console.error("API Error:", error);
    container.innerHTML = `<p class="text-red-600 text-sm">❌ Failed to load skills. Please try again later.</p>`;
  });

});
</script>


      





  </div>
</body>
</html>
