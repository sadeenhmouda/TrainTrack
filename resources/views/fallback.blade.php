<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Fallback Logic</title>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body class="bg-[#f8f8f8] font-[Roboto]" x-data="fallbackScreen()">

  <div class="max-w-5xl mx-auto px-4 py-12">

    <!-- Top Message -->
    <div class="bg-white text-center rounded-xl shadow-md p-6 mb-10">
      <h2 class="text-lg font-semibold text-[#6A1B9A] mb-2">You're Close!</h2>
      <p class="text-sm text-gray-700">Add a few more skills or subjects to complete your match.</p>
    </div>

    <!-- Recommended Technical Skills -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
      <h3 class="text-[16px] font-semibold text-[#333] mb-4">⚡ Recommended Technical Skills</h3>
      <div class="flex flex-wrap gap-3">
        <template x-for="skill in technicalSkills" :key="skill.id">
          <button 
            @click="toggleTech(skill.id)"
            class="px-4 py-1.5 rounded-full border text-sm transition-all"
            :class="selectedTech.includes(skill.id)
              ? 'bg-[#ede7f6] border-[#6A1B9A] text-[#6A1B9A] font-medium'
              : 'bg-gray-200 text-gray-800 border-gray-300 hover:border-[#6A1B9A]'"
            x-text="skill.name">
          </button>
        </template>
      </div>
    </div>

    <!-- Recommended Non-Technical Skills -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
      <h3 class="text-[16px] font-semibold text-[#333] mb-4">🌟 Recommended Non - Technical Skills</h3>
      <div class="flex flex-wrap gap-3">
        <template x-for="skill in nonTechnicalSkills" :key="skill.id">
          <button 
            @click="toggleNonTech(skill.id)"
            class="px-4 py-1.5 rounded-full border text-sm transition-all"
            :class="selectedNonTech.includes(skill.id)
              ? 'bg-[#ede7f6] border-[#6A1B9A] text-[#6A1B9A] font-medium'
              : 'bg-gray-200 text-gray-800 border-gray-300 hover:border-[#6A1B9A]'"
            x-text="skill.name">
          </button>
        </template>
      </div>
    </div>

    <!-- Buttons -->
    <div class="flex justify-between mt-12">
      <button
        @click="skipFallback"
        class="min-w-[130px] px-6 py-2 rounded-md bg-gray-400 text-white font-medium hover:bg-gray-500 transition">
        Try Later
      </button>
      <button
        @click="submitImprovement"
        class="min-w-[130px] px-6 py-2 rounded-md bg-[#6A1B9A] text-white font-medium hover:bg-[#5a1584] transition">
        Submit Improvement
      </button>
    </div>

  </div>

  <!-- AlpineJS Logic -->
  <script>
    function fallbackScreen() {
      return {
        technicalSkills: [
          { id: 101, name: 'Computer Networks' },
          { id: 102, name: 'Docker' },
          { id: 103, name: 'Git' },
          { id: 104, name: 'Linux' },
          { id: 105, name: 'CI/CD' }
        ],
        nonTechnicalSkills: [
          { id: 201, name: 'Communication' },
          { id: 202, name: 'Time Management' },
          { id: 203, name: 'Teamwork' },
          { id: 204, name: 'Problem Solving' }
        ],
        selectedTech: [],
        selectedNonTech: [],

        toggleTech(id) {
          this.selectedTech.includes(id)
            ? this.selectedTech = this.selectedTech.filter(i => i !== id)
            : this.selectedTech.push(id);
        },

        toggleNonTech(id) {
          this.selectedNonTech.includes(id)
            ? this.selectedNonTech = this.selectedNonTech.filter(i => i !== id)
            : this.selectedNonTech.push(id);
        },

        skipFallback() {
          window.location.href = '/traintrack/summary';
        },

        submitImprovement() {
          const payload = {
            tech_skills: this.selectedTech,
            non_tech_skills: this.selectedNonTech
          };

          console.log('✅ Payload to submit:', payload);

          // TODO: Replace with actual POST request when API is ready
          window.location.href = '/traintrack/summary';
        }
      };
    }
  </script>

</body>
</html>
