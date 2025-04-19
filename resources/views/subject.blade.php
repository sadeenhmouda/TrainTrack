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
  <div class="w-full h-full flex justify-center items-center">


    <!-- Main Wizard Layout -->
    <div class="w-full h-full flex bg-white">


      <!-- Left Side (Stepper) -->
      <div class="w-[300px] px-6 py-8 bg-white border-r border-[#e0e0e0]">
        <!-- App Logo -->
        <img src="{{ asset('train.jpg') }}" style="width: 200px;">


        <!-- Stepper Title -->
        <h3 class="w-[238px] h-[24px] text-[18px] font-normal text-[#333] mb-4 ml-[10px]">Progress Guide</h3>


      <h3 class="w-[143px] h-[24px] text-[15px] font-normal text-[#333] mb-3 ml-[15px]">Progress Guide</h3>


<h3 class="w-[143px] h-[24px] text-[15px] font-normal text-[#333] mb-3 ml-[15px]">Progress Guide</h3>


<!-- Stepper Container -->
<div class="relative">
  <!-- Vertical line behind steps -->
  <div class="absolute top-0 bottom-0 left-[16px] w-[1px] bg-gray-300 z-0"></div>


  <div class="flex flex-col space-y-3 relative z-10">
    <!-- Step 1 -->
    <div class="flex items-center relative">
      <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border-[2px] border-[#6A1B9A] flex items-center justify-center text-[#6A1B9A] font-semibold text-sm mr-3">1</div>
      <div class="text-sm text-[#333] font-medium">Let’s Get to Know You</div>
    </div>


    <!-- Step 2 -->
    <div class="flex items-start relative">
      <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#757575] font-medium text-sm mr-3">2</div>
      <div class="flex flex-col justify-center">
        <div class="text-sm text-[#333] font-medium">Subject of Interest</div>


        <!-- Substeps -->
        <div class="mt-3 space-y-2">
          <div class="flex items-center">
            <div class="w-[23.5px] h-[23.5px] rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center">
              <span class="text-[9px] font-medium text-[#757575]">2.1</span>
            </div>
            <div class="ml-2 text-[13px] text-[#333]">Select Interest Categories</div>
          </div>
          <div class="flex items-center">
            <div class="w-[23.5px] h-[23.5px] rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center">
              <span class="text-[9px] font-medium text-[#757575]">2.2</span>
            </div>
            <div class="ml-2 text-[13px] text-[#333]">Choose Topics</div>
          </div>
        </div>
      </div>
    </div>


    <!-- Steps 3–6 -->
    <div class="flex items-center relative">
      <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#757575] font-medium text-sm mr-3">3</div>
      <div class="text-sm text-[#333] font-medium">Technical Skills</div>
    </div>


    <div class="flex items-center relative">
      <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#757575] font-medium text-sm mr-3">4</div>
      <div class="text-sm text-[#333] font-medium">Non-Technical Skills</div>
    </div>


    <div class="flex items-center relative">
      <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#757575] font-medium text-sm mr-3">5</div>
      <div class="text-sm text-[#333] font-medium">Advance Preferences</div>
    </div>


    <div class="flex items-center relative">
      <div class="w-8 h-8 rounded-full bg-[#F5F5F5] border border-gray-300 flex items-center justify-center text-[#757575] font-medium text-sm mr-3">6</div>
      <div class="text-sm text-[#333] font-medium">Summary & Results</div>
    </div>
  </div>
</div></div>




      <!-- Right Side (Form Content) -->
      <div class="flex-1 p-12 overflow-y-auto">
        <h1 class="text-[28px] font-semibold mb-4">📚 Subject of Interest</h1>
        <p class="text-[16px] text-[#333]">Select max 3 categories to get personalized subject suggestions.</p>
      </div>
    </div>
  </div>


  <!-- Bottom Buttons -->
  <div class="absolute bottom-4 left-0 w-full px-10 flex justify-between items-end">
    <!-- Back Button -->
<a href="{{ route('traintrack') }}">
  <button
    class="w-[159px] h-[47px] border-2 border-[#6A1B9A] text-[#6A1B9A] text-[25px] font-medium rounded-[12px] transition-all duration-300 mx-80">
    Back
  </button>
</a>



    <!-- Next Button -->
    <button
      class="w-[159px] h-[47px] bg-[#6A1B9A] text-white text-[25px] font-medium rounded-[12px] hover:bg-[#5a1784] transition duration-300">
      Next
    </button>
  </div>


  <!-- Back Button Toggle -->
  <script>
    const backBtn = document.getElementById('backBtn');
    backBtn.addEventListener('click', () => {
      backBtn.classList.toggle('bg-[#6A1B9A]');
      backBtn.classList.toggle('text-white');
      backBtn.classList.toggle('border-none');
    });
  </script>


</body>
</html>





