<div class="sidebar">
  <img src="{{ asset('traintrack2.png') }}" class="sidebar-logo">
  <div class="sidebar-title">Progress Guide</div>

  <div class="stepper-container">
    <div class="vertical-line"></div>
    <div class="step-list">

      {{-- Step 1 --}}
      <div class="step">
        <div class="step-circle 
          {{ $currentStep == 1 ? 'active' : ($currentStep > 1 ? 'filled' : 'inactive') }}">
          1
        </div>
        <div class="step-label">Let’s Get to Know You</div>
      </div>

      {{-- Step 2 --}}
      <div class="step">
        <div class="step-circle 
          {{ $currentStep == 2 && $currentSubstep == '2.1' ? 'half-active' : 
             ($currentStep == 2 && $currentSubstep == '2.2' ? 'active' : 
             ($currentStep > 2 ? 'filled' : 'inactive')) }}">
          2
        </div>
        <div class="flex flex-col">
          <div class="step-label">knowledge Background</div>

          {{-- Substep 2.1 --}}
          <div class="substep">
           <div class="substep-circle 
  {{ $currentSubstep == '2.1' ? 'active' : 
     ($currentStep > 2 || $currentSubstep == '2.2' ? 'filled' : 'inactive') }}">
  2.1
</div>


            <div class="substep-text">Select Interest Categories</div>
          </div>

          {{-- Substep 2.2 --}}
          <div class="substep">
            <div class="substep-circle 
              {{ $currentSubstep == '2.2' ? 'active' : 
                 (in_array($currentStep, [3, 4, 5, 6]) ? 'filled' : 'inactive') }}">
              2.2
            </div>
            <div class="substep-text">Choose Topics</div>
          </div>
        </div>
      </div>

      {{-- Step 3 --}}
      <div class="step">
        <div class="step-circle 
          {{ $currentStep == 3 ? 'active' : ($currentStep > 3 ? 'filled' : 'inactive') }}">
          3
        </div>
        <div class="step-label">Technical Skills</div>
      </div>

      {{-- Step 4 --}}
      <div class="step">
        <div class="step-circle 
          {{ $currentStep == 4 ? 'active' : ($currentStep > 4 ? 'filled' : 'inactive') }}">
          4
        </div>
        <div class="step-label">Non-Technical Skills</div>
      </div>

      {{-- Step 5 --}}
      <div class="step">
        <div class="step-circle 
          {{ $currentStep == 5 ? 'active' : ($currentStep > 5 ? 'filled' : 'inactive') }}">
          5
        </div>
        <div class="step-label">Advance Preferences</div>
      </div>

      {{-- Step 6 --}}
      <div class="step">
        <div class="step-circle 
          {{ $currentStep == 6 ? 'active' : ($currentStep > 6 ? 'filled' : 'inactive') }}">
          6
        </div>
        <div class="step-label"> Results</div>
      </div>

    </div>
  </div>
</div>