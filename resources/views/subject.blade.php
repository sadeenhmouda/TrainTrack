<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Train Track Wizard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen w-screen bg-[#f0f0f0] font-[Roboto] relative">

  <!-- Frame Container -->
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
          <div class="-ml-4 absolute top-0 bottom-0 left-[32px] w-[1px] bg-gray-300 z-0"></div>

          <div class="flex flex-col space-y-3 relative z-10">
            <!-- Step 1 -->
            <div class="flex items-center relative">
              <div class="w-8 h-8 rounded-full bg-[#6A1B9A] border-[2px] border-[#6A1B9A] flex items-center justify-center text-white font-medium text-sm mr-3">1</div>
              <div class="mt-1 text[13px] text-[#333] font-medium">Let’s Get to Know You</div>
            </div>

            <!-- Step 2 -->
            <div class="flex items-start relative">
              <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border -[2px] border-[#6A1B9A] flex items-center justify-center text-[#0f0f0f] font-medium text-sm mr-3">2</div>
              <div class="flex flex-col justify-center">
                <div class="mt-1 text[13px] text-[#333] font-medium">Subject of Interest</div>
                <!-- Substeps -->
                <div class="mt-3 space-y-3">
                  <div class="flex items-center">
                    <div class="w-[29px] h-[29px] rounded-full bg-[#F5F5F5] border border-[#6A1B9A] flex items-center justify-center">
                      <span class="text-[12px] font-medium text-[#0f0f0f]">2.1</span>
                    </div>
                    <div class="ml-2 text-[15px] text-[#333]">Select Interest Categories</div>
                  </div>
                  <div class="flex items-center">
                    <div class="w-[29px] h-[29px] rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center">
                      <span class="text-[12px] font-medium text-[#0f0f0f]">2.2</span>
                    </div>
                    <div class="ml-2 text-[15px] text-[#333]">Choose Topics</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Steps 3–6 -->
            <div class="flex items-center relative">
              <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#0f0f0f] font-medium text-sm mr-3">3</div>
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

<!-- Right Side (Subject Categories Step) -->
<div class="flex-1 px-10 py-8 bg-white" x-data="subjectCategoryStep()" x-init="fetchCategories()">

  <!-- Heading -->
  <h1 class="text-[28px] font-semibold mb-2">🧠 Knowledge Background</h1>
  <p class="text-[15px] text-[#333] ml-10 mb-6"> Select max 3 categories to get personalized subject suggestions </p>

  <!-- Category Cards Grid -->
  <div class="grid grid-cols-4 gap-x-6 gap-y-8 justify-items-center mt-6">
  <template x-for="category in categories" :key="category.id">
    <div
      @click="toggleCategory(category.id)"
      :class="selectedCategories.includes(category.id)
              ? 'border-2 border-[#6A1B9A] bg-[#f9f0ff]'
              : 'border border-gray-300 hover:border-[#6A1B9A]'"
      class="cursor-pointer flex flex-col items-center justify-center rounded-[20px] p-6 transition-all h-[170px] max-w-[210px] w-full"
    >
      <!-- 🖼️ Dynamic Image from local or API -->
      <img :src="category.image_url" alt="icon" class="w-[48px] h-[48px] mb-3" />

      <!-- 🏷️ Category Name -->
      <div class="text-center text-[14px] font-medium text-[#333]" x-text="category.name"></div>
    </div>
  </template>
</div>


  <!-- Bottom Buttons (Fixed Placement) -->
  <div class="absolute bottom-4 left-0 w-full px-10 flex justify-between items-end">
    <!-- Back Button -->
    <a href="{{ route('traintrack') }}">
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

  <!-- Optional Button Styling Script -->
  <script>
    const backBtn = document.getElementById('backBtn');
    backBtn.addEventListener('click', () => {
      backBtn.classList.toggle('bg-[#6A1B9A]');
      backBtn.classList.toggle('text-white');
      backBtn.classList.toggle('border-none');
    });
  </script>
</div>

<!-- AlpineJS -->
<!--<script src="/js/mockSubjectCategories.js"></script>-->

<!-- Load AlpineJS -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<!-- ✅ Updated AlpineJS Logic -->
<script>
  function subjectCategoryStep() {
    return {
      categories: [],               // Loaded from backend API
      selectedCategories: [],       // Selected category IDs

      // 🔁 Load categories from backend API
      async fetchCategories() {
        try {
          const response = await fetch("https://train-track-backend.onrender.com/wizard/subject-categories");
          const result = await response.json();
          if (result.success) {
            this.categories = result.data;
          }
        } catch (error) {
          console.error("Error fetching categories:", error);
        }
      },

      // ✅ Toggle category selection
      toggleCategory(id) {
        if (this.selectedCategories.includes(id)) {
          this.selectedCategories = this.selectedCategories.filter(c => c !== id);
        } else {
          this.selectedCategories.push(id);
        }
      },

      // ✅ Save and go to Step 2.2
      saveAndGoNext() {
        if (this.selectedCategories.length === 0) {
          alert("Please select at least one category before continuing.");
          return;
        }

        localStorage.setItem('selectedCategoryIds', this.selectedCategories.join(','));
        window.location.href = '{{ route("traintrack.subject2") }}';
      }
    };
  }
</script>




      





  </div>
</body>
</html>
