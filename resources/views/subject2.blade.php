<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Train Track Wizard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="body" style="
                      background-color: white;
                      padding-bottom: 5rem;">

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
              <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#0f0f0f] font-medium text-sm mr-3">2</div>
              <div class="flex flex-col justify-center">
                <div class="mt-1 text[13px] text-[#333] font-medium">Subject of Interest</div>
                <!-- Substeps -->
                <div class="mt-3 space-y-3">
                  <div class="flex items-center">
                    <div class="w-[29px] h-[29px] rounded-full bg-[#6A1B9A] border border-[#6A1B9A]  flex items-center justify-center">
                      <span class="text-[12px] font-medium text-white">2.1</span>
                    </div>
                    <div class="ml-2 text-[15px] text-[#333]">Select Interest Categories</div>
                  </div>
                  <div class="flex items-center">
                    <div class="w-[29px] h-[29px] rounded-full bg-[#F5F5F5] border border-[#6A1B9A] flex items-center justify-center">
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

   <!-- Right Side (Step 2.2 – Choose Topics) -->
<div class="flex-1 px-10 py-8 bg-white" x-data="subjectTopicsStep()" x-init="fetchTopics()"> 

<!-- Page Titles -->
<h1 class="text-[28px] font-semibold mb-2">🧠 Knowledge Background</h1>
<h2 class="text-[20px] font-medium mb-4">🎯 Choose Topics</h2>
<p class="text-[15px] text-[#333] ml-2 mb-6">
  Select up to <strong>7 topics</strong> based on your selected interest categories.
</p>

<!-- Categories & Topics Display -->
<template x-for="category in categories" :key="category.Subject_category_id">
  <div class="mb-10">
    <!-- Category Title -->
    <h2 class="text-[20px] font-semibold text-[#333] mb-3" x-text="category.Subject_category_name"></h2>

    <!-- Subject Tags -->
    <div class="flex flex-wrap gap-3 bg-white rounded-lg p-4 shadow-sm">
      <template x-for="subject in category.subjects" :key="subject.id">
        <button
          @click="toggleTopic(subject.id)"
          :class="selectedTopics.includes(subject.id)
            ? 'bg-[#f3e5f5] border-[#6A1B9A] text-[#6A1B9A]'
            : 'border-gray-300 text-[#333] hover:border-[#6A1B9A]'"
          class="px-4 py-2 rounded-full border text-sm transition-all"
          x-text="subject.name">
        </button>
      </template>
    </div>
  </div>
</template>

<!-- Navigation Buttons -->
<div class="navbarbtm" 
style="
  width: 100%;
  padding-left: 2.5rem;
  padding-right: 5.5rem;
  padding-top: 1.5rem;
  padding-bottom: 1.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: white;">
  
  <!-- Back -->
  <a href="{{ route('traintrack.subject') }}">
    <button class="bckbutton" style="width:130px; height:40px; border:2px solid #6A1B9A; color:#6A1B9A; font-size:20px; font-weight:500; border-radius:12px; transition:all 300ms; margin-right:40rem;">
      Back
    </button>
  </a>

  <!-- Next -->
  <button
    @click="saveAndGoNext()"
    style="width:130px; height:40px; background-color:#6A1B9A; color:white; font-size:20px; font-weight:500; border-radius:12px; transition:background-color 300ms;">
    Next
  </button>
</div>


 <!-- ✅ Add Alpine.js for interactivity -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
function subjectTopicsStep() {
  return {
    categories: [],
    selectedTopics: [],

    fetchTopics() {
      const selectedIds = localStorage.getItem('selectedCategoryIds');
      if (!selectedIds) return;

      fetch(`https://train-track-backend.onrender.com/wizard/subjects?ids=${selectedIds}`)
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            this.categories = data.data;
          }
        })
        .catch(err => console.error("API error:", err));
    },

    toggleTopic(id) {
      if (this.selectedTopics.includes(id)) {
        this.selectedTopics = this.selectedTopics.filter(t => t !== id);
      } else  {
        this.selectedTopics.push(id);
      }
    },

    saveAndGoNext() {
      localStorage.setItem('selectedSubjectIds', this.selectedTopics.join(','));
      window.location.href = '{{ route("traintrack.technical") }}';
    }
  };
}
</script>

      





  </div>
</body>
</html>
