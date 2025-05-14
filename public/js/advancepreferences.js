async function submitToExpertSystem(isSkip = false) {
  const selectedSubjects = JSON.parse(localStorage.getItem("selectedSubjectIds") || "[]");
  const selectedTechSkills = JSON.parse(localStorage.getItem("selectedTechnicalSkills") || "[]");
  const selectedNonTechSkills = JSON.parse(localStorage.getItem("selectedNonTechnicalSkills") || "[]");
  const selectedTrainingModeId = localStorage.getItem("trainingModeId");
  const selectedCompanySizeId = localStorage.getItem("companySizeId");
  const selectedIndustryIds = JSON.parse(localStorage.getItem("industryIds") || "[]");
  const selectedCultures = JSON.parse(localStorage.getItem("companyCulture") || "[]");

  const trainingModeDesc = localStorage.getItem("trainingModeDesc");
  const companySizeDesc = localStorage.getItem("companySizeDesc");
  const industryNames = JSON.parse(localStorage.getItem("selectedIndustryNames") || "[]");
  const cultureMap = JSON.parse(localStorage.getItem("cultureMap") || "{}");

  const fullName = localStorage.getItem("fullName");
  const gender = localStorage.getItem("gender");
  const majorId = parseInt(localStorage.getItem("majorId"));
  const dateOfBirth = localStorage.getItem("dateOfBirth");

  console.log("\ud83d\udce6 submitToExpertSystem() called");
  console.log("\ud83c\udfaf full_name:", fullName);
  console.log("\ud83c\udfaf gender:", gender);
  console.log("\ud83c\udfaf major_id:", majorId);
  console.log("\ud83c\udfaf date_of_birth:", dateOfBirth);
  console.log("\ud83d\udcda subjects:", selectedSubjects);
  console.log("\ud83d\udee0\ufe0f technical_skills:", selectedTechSkills);
  console.log("\ud83d\udca1 non_technical_skills:", selectedNonTechSkills);
  console.log("\ud83c\udfe2 training_modes:", selectedTrainingModeId);
  console.log("\ud83c\udfe2 company_sizes:", selectedCompanySizeId);
  console.log("\ud83c\udfed industries:", selectedIndustryIds);
  console.log("\ud83d\udcbc company_culture:", selectedCultures);

  if (!fullName || !gender || !majorId || !dateOfBirth) {
    Swal.fire("Error", "Missing basic user info. Please restart the wizard.", "error");
    return;
  }

  if (selectedSubjects.length < 3 || selectedSubjects.length > 7) {
    Swal.fire("Error", "Please select between 3 and 7 subjects.", "error");
    return;
  }

  const preferencesFilled =
    selectedTrainingModeId ||
    selectedCompanySizeId ||
    selectedIndustryIds.length > 0 ||
    selectedCultures.length > 0;

  if (!isSkip && preferencesFilled) {
    if (selectedTechSkills.length < 3 || selectedTechSkills.length > 8) {
      Swal.fire("Error", "Please select between 3 and 8 technical skills.", "error");
      return;
    }

    if (selectedNonTechSkills.length < 3 || selectedNonTechSkills.length > 5) {
      Swal.fire("Error", "Please select between 3 and 5 non-technical skills.", "error");
      return;
    }
  }

  const cleanTechSkills = selectedTechSkills.map(id => parseInt(id));
  const cleanNonTechSkills = selectedNonTechSkills.map(id => parseInt(id));
  const cleanIndustryIds = selectedIndustryIds.map(id => parseInt(id));
  const cultureIds = selectedCultures.map(name => cultureMap[name]).filter(Boolean);

  const payload = {
    full_name: fullName,
    gender: gender,
    major_id: majorId,
    date_of_birth: dateOfBirth,
    subjects: selectedSubjects,
    technical_skills: cleanTechSkills,
    non_technical_skills: cleanNonTechSkills,
    is_fallback: false,
    previous_fallback_ids: [],

    advanced_preferences: preferencesFilled && !isSkip
      ? {
          training_mode: trainingModeDesc || null,
          company_size: companySizeDesc || null,
          preferred_industry: industryNames,
          company_culture: selectedCultures
        }
      : {},

    company_filter_ids: preferencesFilled && !isSkip
      ? {
          training_modes: selectedTrainingModeId ? [parseInt(selectedTrainingModeId)] : [],
          company_sizes: selectedCompanySizeId ? [parseInt(selectedCompanySizeId)] : [],
          industries: cleanIndustryIds,
          cultures: cultureIds
        }
      : {}
  };

  console.log("\ud83d\ude80 Submitting final payload to backend:", payload);

  Swal.fire({
    title: "Loading...",
    didOpen: () => Swal.showLoading(),
    allowOutsideClick: false
  });

  try {
    const submitRes = await fetch("https://train-track-backend.onrender.com/wizard/submit", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload)
    });

    const submitData = await submitRes.json();

    if (!submitData.success) {
      Swal.close();
      Swal.fire("Error", submitData.message || "Failed to submit wizard data.", "error");
      return;
    }

    const recoRes = await fetch("https://train-track-backend.onrender.com/recommendations", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload)
    });

    const recoData = await recoRes.json();
    Swal.close();

    if (recoData.success) {
      localStorage.setItem("recommendationResult", JSON.stringify(recoData));
      if (recoData.fallback_triggered) {
        localStorage.setItem("fallbackTriggered", "true");
      }

      localStorage.setItem("finalWizardData", JSON.stringify(payload));
      window.location.href = "/traintrack/summaryresults";
    } else {
      Swal.fire("Error", "Recommendation failed. Try again.", "error");
    }
  } catch (err) {
    console.error("\u274c Submit error:", err);
    Swal.close();
    Swal.fire("Error", "Network error occurred. Try again.", "error");
  }
}
