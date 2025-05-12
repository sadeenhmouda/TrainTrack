document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("skipAndSubmitBtn").addEventListener("click", () => {
    preferencesFilled = false;
    submitToExpertSystem();
  });

  document.getElementById("submitWithPrefsBtn").addEventListener("click", () => {
    preferencesFilled = true;
    submitToExpertSystem();
  });

  fetchAdvancedPreferences();
});

let selectedSubjects = JSON.parse(localStorage.getItem("selectedSubjectIds")) || [];
let selectedTechnicalSkills = JSON.parse(localStorage.getItem("selectedTechnicalSkills")) || [];
let selectedNonTechnicalSkills = JSON.parse(localStorage.getItem("selectedNonTechnicalSkills")) || [];

let selectedTrainingModeId = localStorage.getItem("trainingModeId");
let selectedCompanySizeId = localStorage.getItem("companySizeId");
let selectedIndustryIds = JSON.parse(localStorage.getItem("industryIds")) || [];

let preferencesFilled = false;

async function fetchAdvancedPreferences() {
  try {
    const res = await fetch("https://train-track-backend.onrender.com/wizard/preferences");
    const data = await res.json();

    if (data.success) {
      console.log("✅ Advanced Preferences Loaded:", data.data);
    } else {
      console.warn("⚠️ Could not load preferences:", data.message);
    }
  } catch (err) {
    console.error("❌ Failed to fetch preferences:", err);
  }
}

async function submitToExpertSystem() {
  // ✅ Subject validation
  if (!selectedSubjects || selectedSubjects.length < 3 || selectedSubjects.length > 7) {
    Swal.fire("Error", "Please select between 3 and 7 subjects before continuing.", "error");
    return;
  }

  // ✅ Conditional validations
  if (preferencesFilled) {
    if (!selectedNonTechnicalSkills || selectedNonTechnicalSkills.length < 3 || selectedNonTechnicalSkills.length > 5) {
      Swal.fire("Error", "Please select between 3 and 5 non-technical skills before continuing.", "error");
      return;
    }

    if (!selectedTechnicalSkills || selectedTechnicalSkills.length < 3 || selectedTechnicalSkills.length >8 ) {
      Swal.fire("Error", "Please select between 3 and 8 technical skills before continuing.", "error");
      return;
    }
  }

  const payload = {
    subjects: selectedSubjects,
    technical_skills: selectedTechnicalSkills,
    non_technical_skills: selectedNonTechnicalSkills,
    is_fallback: false,
    previous_fallback_ids: [],
    advanced_preferences: preferencesFilled
      ? {
          training_modes: selectedTrainingModeId ? [parseInt(selectedTrainingModeId)] : [],
          company_sizes: selectedCompanySizeId ? [parseInt(selectedCompanySizeId)] : [],
          industries: selectedIndustryIds.map(Number)
        }
      : {}
  };

  console.log("🛠️ Sending to Expert System:", payload);

  Swal.fire({
    title: "Loading...",
    didOpen: () => Swal.showLoading(),
    allowOutsideClick: false
  });

  try {
    const response = await fetch("https://train-track-backend.onrender.com/wizard/submit",  {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload)
    });

    const result = await response.json();
    Swal.close();

    if (result.success) {
      localStorage.setItem("recommendationResult", JSON.stringify(result));
      if (result.fallback_triggered) {
        localStorage.setItem("fallbackTriggered", "true");
      }
      window.location.href = "/traintrack/summaryresults";
    } else {
      Swal.fire("Error", result.message || "Something went wrong", "error");
    }
  } catch (error) {
    Swal.close();
    Swal.fire("Error", "Network error. Please try again.", "error");
  }
}
