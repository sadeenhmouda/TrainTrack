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
  <div class="w-full h-full flex bg-white ">

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
              <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border-[2px] border-[#6A1B9A] flex items-center justify-center text-[#0f0f0f] font-medium text-sm mr-3">1</div>
              <div class="mt-1 text[13px] text-[#333] font-medium">Let’s Get to Know You</div>
            </div>

            <!-- Step 2 -->
            <div class="flex items-start relative">
              <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#0f0f0f] font-medium text-sm mr-3">2</div>
              <div class="flex flex-col justify-center">
                <div class="mt-1 text[13px] text-[#333] font-medium ">Subject of Interest</div>
                <!-- Substeps -->
                <div class="mt-3 space-y-3">
                  <div class="flex items-center">
                    <div class="w-[29px] h-[29px] rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center">
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
              <div class="text[1px] text-[#333] font-medium">Non-Technical Skills</div>
            </div>
            <div class="flex items-center relative">
              <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#0f0f0f] font-medium text-sm mr-3">5</div>
              <div class="text[13px] text-[#333] font-medium">Advance Preferences</div>
            </div>
            <div class="flex items-center relative">
              <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#0f0f0f] font-medium text-sm mr-3">6</div>
              <div class="text[16px] text-[#333] font-medium">Summary & Results</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Side (New Section) -->
<div class="flex-1 px-10 py-8 bg-white" x-data="formStep1()">

<h1 class="text-[28px] font-medium mb-2">🧠 Let's Get to Know You.</h1>
  <p class="text-[15px] text-[#333] ml-10 mb-6">
    This is a test layout for the full-screen wizard interface.
  </p>

  <!-- Full Name -->
  <div class="mb-6">
    <label for="fullName" class="block text-sm font-medium text-[#333] ml-5 mb-2">Full Name</label>
    <input type="text" id="fullName" x-model="fullName"
      @blur="validateFullName()"
      minlength="3" maxlength="50"
      placeholder="Enter your full name"
      :class="invalidName ? 'border-red-500' : 'border-gray-300'"
      class="w-1/2 px-4 py-2 rounded-md border hover:border-[#B388CB] focus:outline-none focus:ring-2 focus:ring-[#B388CB] text-sm ml-5 transition-all" />
  </div>

  <!-- Gender Selection -->
  <div class="mb-6">
    <label class="block text-sm font-medium text-[#333] ml-5 mb-2">Gender</label>
    <div class="flex gap-4 ml-5">
      <button type="button"
        @click="gender = 'Male'"
        :class="gender === 'Male' ? 'border-[#6A1B9A] bg-[#f3e5f5]' : 'border-gray-300'"
        class="flex items-center gap-2 px-4 py-2 rounded-full text-[#333] text-sm border hover:border-[#6A1B9A] transition-all">
         Male
      </button>
      <button type="button"
        @click="gender = 'Female'"
        :class="gender === 'Female' ? 'border-[#6A1B9A] bg-[#f3e5f5]' : 'border-gray-300'"
        class="flex items-center gap-2 px-4 py-2 rounded-full text-[#333] text-sm border hover:border-[#6A1B9A] transition-all">
         Female
      </button>
    </div>
  </div>

  <!-- Major Selection -->
  <div class="mb-6">
    <label class="block text-sm font-medium text-[#333] ml-5 mb-2">Major</label>
    <div class="flex flex-col gap-3 ml-5">
      <template x-for="(item, index) in majors" :key="index">
        <div @click="selectedMajor = item.label"
          :class="selectedMajor === item.label 
                  ? 'bg-[#EBDEF0] border-[#6A1B9A]' 
                  : 'bg-[#F5F5F5] border-gray-300 hover:border-[#6A1B9A]'"
          class="relative cursor-pointer flex items-center justify-between px-4 py-1.5 rounded-full text-sm text-[#333] border w-fit transition-all">

          <div class="flex items-center group">
            <span x-text="item.icon + ' ' + item.label"></span>

            <!-- Info Tooltip -->
            <div class="relative ml-2">
              <span class="cursor-pointer text-gray-500 text-[13px]">ⓘ</span>
              <div
                class="absolute left-full top-1/2 transform -translate-y-1/2 ml-2 bg-[#f3e5f5] text-[#333] text-xs rounded-lg px-3 py-1 border border-[#6A1B9A] shadow-md w-[220px] hidden group-hover:block z-10 whitespace-normal">
                <span x-text="item.description"></span>
              </div>
            </div>
          </div>
        </div>
      </template>
    </div>
  </div>

  <!-- Next Button -->
  <div class="fixed bottom-4 right-10">
    <button
      @click="validateAndGoNext()"
      class="w-[130px] h-[40px] bg-[#6A1B9A] text-white text-[20px] font-medium rounded-[12px] hover:bg-[#5a1784] transition duration-300">
      Next
    </button>
  </div>

</div>

<!-- AlpineJS and SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Form Logic -->
<script>
function formStep1() {
  return {
    fullName: '',
    gender: '',
    selectedMajor: '',
    invalidName: false,

    majors: [
      { label: 'Computer Science Apprenticeship Program', icon: '☁️', description: 'Hands-on learning through real-world software development projects.' },
      { label: 'Management Information System', icon: '💼', description: 'Using technology to improve business processes and decision-making.' },
      { label: 'Network Information System', icon: '🔐', description: 'Covers network administration, cybersecurity, and infrastructure planning.' },
      { label: 'Computer Engineering', icon: '🛠️', description: 'Blends hardware design with software programming and embedded systems.' },
      { label: 'Computer Science', icon: '💻', description: 'Core CS topics: algorithms, data structures, AI, and software development.' }
    ],

    validateFullName() {
      this.invalidName = !this.fullName || this.fullName.length < 3;
    },

    validateAndGoNext() {
      this.validateFullName();

      if (!this.fullName || !this.gender || !this.selectedMajor) {
        Swal.fire({
          title: 'Missing Information!',
          text: 'Please fill out your Full Name, Gender, and Major to continue 🚀',
          icon: 'warning',
          confirmButtonText: 'OK'
        });
      } else {
        // Save to localStorage
        const formData = {
          fullName: this.fullName,
          gender: this.gender,
          selectedMajor: this.selectedMajor
        };
        localStorage.setItem('personal_info', JSON.stringify(formData));

        // Redirect to next page
        window.location.href = "{{ route('traintrack.subject') }}";
      }
    }
  }
}
</script>
   





  </div>
</body>
</html>
