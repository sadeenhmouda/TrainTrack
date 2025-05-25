// ✅ fallbackimprove.js (Final Version with Fix)
document.addEventListener("DOMContentLoaded", async function () {
  const API_BASE = "https://train-track-backend.onrender.com/";
  const subjectList = document.getElementById("subjectList");
  const technicalList = document.getElementById("technicalSkillList");
  const nonTechList = document.getElementById("nonTechnicalSkillList");
  const submitBtn = document.getElementById("submitImprovementBtn");
  const skipBtn = document.getElementById("skipImproveBtn");

  const selectedSubjects = new Set();
  const selectedTechSkills = new Set();
  const selectedNonTechSkills = new Set();

  // ✅ Skip Improve Button Logic (Updated)
  skipBtn.addEventListener("click", () => {
    const cachedResult = localStorage.getItem("recommendationResult");
    const fallbackPayload = localStorage.getItem("previousFallbackPayload");

    if (!cachedResult || !fallbackPayload) {
      alert("⚠️ Missing fallback data. Please restart the wizard.");
      window.location.href = "/traintrack";
      return;
    }

    // ✅ Set flag and redirect immediately to summary page
    localStorage.setItem("fallbackTriggered", "true");
    localStorage.setItem("finalWizardData", fallbackPayload);
    window.location.href = "/traintrack/summaryresults";
  });

  // ✅ Start fetching fallback data
  fetchFallbackData();

  function fetchFallbackData() {
    const rawPayload = localStorage.getItem("previousFallbackPayload") || "{}";
    const payload = JSON.parse(rawPayload);

    if (!payload || Object.keys(payload).length === 0) {
      alert("⚠️ Missing fallback data. Please go back and retry.");
      return;
    }

    const url = `${API_BASE}recommendations/fallback-prerequisites`;
    console.log("📡 Fetching from:", url);

    fetch(url, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload)
    })
      .then(res => res.json())
      .then(data => {
        console.log("✅ Backend returned fallback data:", data);

        if (!data.missing_prerequisites) {
          console.warn("⚠️ No fallback options returned.");
          alert("⚠️ No fallback options returned.");
          return;
        }

        renderOptions(data.missing_prerequisites.subjects || [], subjectList, selectedSubjects);
        renderOptions(data.missing_prerequisites.technical_skills || [], technicalList, selectedTechSkills);
        renderOptions(data.missing_prerequisites.non_technical_skills || [], nonTechList, selectedNonTechSkills);
      })
      .catch(err => {
        console.error("❌ Error fetching fallback prerequisites:", err);
        alert("❌ Could not fetch fallback data.");
      });
  }

  function renderOptions(array, container, selectionSet) {
    container.innerHTML = "";
    array.forEach(item => {
      const pill = document.createElement("div");
      pill.className = "pill";
      pill.textContent = item.name || `⚠️ Unknown ${item.id}`;
      pill.onclick = () => {
        pill.classList.toggle("selected");
        if (selectionSet.has(item.id)) {
          selectionSet.delete(item.id);
        } else {
          selectionSet.add(item.id);
        }
      };
      container.appendChild(pill);
    });
  }

  submitBtn.addEventListener("click", function () {
    if (
      selectedSubjects.size === 0 &&
      selectedTechSkills.size === 0 &&
      selectedNonTechSkills.size === 0
    ) {
      alert("⚠️ Please select at least one improvement before submitting.");
      return;
    }

    const previousPayload = JSON.parse(localStorage.getItem("previousFallbackPayload") || "{}");
    const fallbackPayload = JSON.parse(localStorage.getItem("previousFallbackPayload") || "{}");
    const advancedPrefs = fallbackPayload.advanced_preferences || {};

    const finalPayload = {
      subjects: [...selectedSubjects],
      technical_skills: [...selectedTechSkills],
      non_technical_skills: [...selectedNonTechSkills],
      is_fallback: true,
      advanced_preferences: {
        training_modes: advancedPrefs.training_modes || [],
        company_sizes: advancedPrefs.company_sizes || [],
        industries: advancedPrefs.preferred_industry_ids || [],
        company_culture: advancedPrefs.company_culture || []
      },
      previous_fallback_ids: previousPayload.previous_fallback_ids || []
    };

    fetch(`${API_BASE}recommendations`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(finalPayload)
    })
      .then(res => res.json())
      .then(result => {
        if (result.success && result.recommended_positions) {
          localStorage.setItem("recommendationResult", JSON.stringify(result));
          localStorage.removeItem("previousFallbackPayload");
          localStorage.setItem("finalWizardData", JSON.stringify(finalPayload));
          window.location.href = "/traintrack/summaryresults";
        } else {
          alert("❌ No improved match found after fallback.");
        }
      })
      .catch(err => {
        console.error("❌ Submit error:", err);
        alert("❌ Something went wrong during submission.");
      });
  });
});