// ✅ Advanced Preferences Logic

let preferencesFilled = false;

// ✅ Wait for page to load
document.addEventListener("DOMContentLoaded", function () {
  const skipBtn = document.getElementById("skipAndSubmitBtn");
  const submitBtn = document.getElementById("submitWithPrefsBtn");

  skipBtn?.addEventListener("click", () => {
    preferencesFilled = false;
    submitToExpertSystem();
  });

  submitBtn?.addEventListener("click", () => {
    preferencesFilled = true;
    submitToExpertSystem();
  });
});

// ✅ Click tracking for preference buttons

document.addEventListener("click", function (e) {
  const target = e.target.closest("button");
  if (!target) return;

  // Training Mode
  if (target.dataset.trainingId) {
    localStorage.setItem("trainingModeId", target.dataset.trainingId);
  }

  // Company Size
  if (target.dataset.sizeId) {
    localStorage.setItem("companySizeId", target.dataset.sizeId);
  }

  // Company Culture (max 2)
  if (target.dataset.cultureName) {
    let selected = JSON.parse(localStorage.getItem("companyCulture") || "[]");
    const name = target.dataset.cultureName;
    if (selected.includes(name)) {
      selected = selected.filter(x => x !== name);
    } else if (selected.length < 2) {
      selected.push(name);
    }
    localStorage.setItem("companyCulture", JSON.stringify(selected));
  }

  // Industry (max 2)
  if (target.dataset.industryId) {
    let selected = JSON.parse(localStorage.getItem("industryIds") || "[]");
    const id = parseInt(target.dataset.industryId);
    if (selected.includes(id)) {
      selected = selected.filter(x => x !== id);
    } else if (selected.length < 2) {
      selected.push(id);
    }
    localStorage.setItem("industryIds", JSON.stringify(selected));
  }
});

// ✅ Submit Data
async function submitToExpertSystem() {
  const selectedSubjects = JSON.parse(localStorage.getItem("selectedSubjectIds") || "[]");
  const selectedTechSkills = JSON.parse(localStorage.getItem("selectedTechnicalSkills") || "[]");
  const selectedNonTechSkills = JSON.parse(localStorage.getItem("selectedNonTechnicalSkills") || "[]");
  const selectedTrainingModeId = localStorage.getItem("trainingModeId");
  const selectedCompanySizeId = localStorage.getItem("companySizeId");
  const selectedIndustryIds = JSON.parse(localStorage.getItem("industryIds") || "[]");
  const selectedCultures = JSON.parse(localStorage.getItem("companyCulture") || "[]");

  // ✅ Validation
  if (selectedSubjects.length < 3 || selectedSubjects.length > 7) {
    Swal.fire("Error", "Please select between 3 and 7 subjects.", "error");
    return;
  }

  if (preferencesFilled) {
    if (selectedTechSkills.length < 3 || selectedTechSkills.length > 8) {
      Swal.fire("Error", "Please select between 3 and 8 technical skills.", "error");
      return;
    }

    if (selectedNonTechSkills.length < 3 || selectedNonTechSkills.length > 5) {
      Swal.fire("Error", "Please select between 3 and 5 non-technical skills.", "error");
      return;
    }
  }

  const payload = {
    subjects: selectedSubjects,
    technical_skills: selectedTechSkills,
    non_technical_skills: selectedNonTechSkills,
    is_fallback: false,
    previous_fallback_ids: [],
    advanced_preferences: preferencesFilled
      ? {
          training_modes: selectedTrainingModeId ? [parseInt(selectedTrainingModeId)] : [],
          company_sizes: selectedCompanySizeId ? [parseInt(selectedCompanySizeId)] : [],
          industries: selectedIndustryIds,
          cultures: selectedCultures
        }
      : {}
  };

  console.log("🚀 Submitting:", payload);

  Swal.fire({
    title: "Loading...",
    didOpen: () => Swal.showLoading(),
    allowOutsideClick: false
  });

  try {
    const res = await fetch("https://train-track-backend.onrender.com/wizard/submit", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload)
    });

    const result = await res.json();
    Swal.close();

    if (result.success) {
      localStorage.setItem("recommendationResult", JSON.stringify(result));
      if (result.fallback_triggered) {
        localStorage.setItem("fallbackTriggered", "true");
      }
      window.location.href = "/traintrack/summaryresults";
    } else {
      Swal.fire("Error", result.message || "Something went wrong.", "error");
    }
  } catch (err) {
    console.error("❌ Submit error:", err);
    Swal.fire("Error", "Network error occurred. Try again.", "error");
  }
}
