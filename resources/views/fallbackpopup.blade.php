<!-- fallback-popup.blade.php -->
<div class="fallback-modal hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50" id="fallbackModal">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-[500px] text-center">
      <h2 class="text-xl font-bold text-purple-700 mb-3">⚡ No Perfect Match Found</h2>
      <p class="text-gray-600 mb-6">
        Based on your selections, no strong position match was found. You can improve your results by selecting more subjects or skills.
      </p>
      <div class="flex justify-center gap-4">
        <button class="btn-purple" onclick="startFallbackImprovement()">🚀Yes, Improve My Selection</button>
        <button class="btn-gray" onclick="skipFallback()">Skip, Maybe Later</button>
      </div>
    </div>
  </div>
  
  