// ✅ fallbackimprove.js (FINAL FIXED VERSION)
document.addEventListener("DOMContentLoaded", async function () {
  const API_BASE = "https://train-track-backend.onrender.com/";

  const subjectList = document.getElementById("subjectList");
  const technicalList = document.getElementById("technicalSkillList");
  const nonTechList = document.getElementById("nonTechnicalSkillList");
  const submitBtn = document.getElementById("submitImprovementBtn");

  const selectedSubjects = new Set();
  const selectedTechSkills = new Set();
  const selectedNonTechSkills = new Set();

  // ✅ Start fetching fallback data
  fetchFallbackData();

  function fetchFallbackData() {
    const rawPayload = localStorage.getItem("previousFallbackPayload") || "{}";
    const payload = JSON.parse(rawPayload);

    if (!payload || Object.keys(payload).length === 0) {
      alert("⚠️ Missing fallback data. Please go back and retry.");
      return;
    }

    fetch(`${API_BASE}recommendations/fallback-prerequisites`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload)
    })
      .then(res => res.json())
      .then(data => {
        console.log("✅ Backend returned fallback data:", data);

        if (!data.success) {
          console.warn("⚠️ Backend says 'no success'. Message:", data.message);
          alert("⚠️ No fallback options returned.");
          return;
        }

        renderOptions(data.missing_prerequisites.subjects, subjectList, selectedSubjects);
        renderOptions(data.missing_prerequisites.technical_skills, technicalList, selectedTechSkills);
        renderOptions(data.missing_prerequisites.non_technical_skills, nonTechList, selectedNonTechSkills);
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
    const finalPayload = {
      subjects: [...selectedSubjects],
      technical_skills: [...selectedTechSkills],
      non_technical_skills: [...selectedNonTechSkills],
      is_fallback: true,
      advanced_preferences: JSON.parse(localStorage.getItem("advancedPreferences") || "{}"),
      previous_fallback_ids: []
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
          window.location.href = "/traintrack/summaryresults";
        } else {
          alert("❌ No improved match found after fallback.");
        }
      })
      .catch(err => console.error("❌ Submit error:", err));
  });
});