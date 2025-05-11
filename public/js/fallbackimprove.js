document.addEventListener("DOMContentLoaded", async function () {
  const subjectList = document.getElementById("subjectList");
  const technicalList = document.getElementById("technicalSkillList");
  const nonTechList = document.getElementById("nonTechnicalSkillList");
  const submitBtn = document.getElementById("submitImprovementBtn");

  // Maps for ID ➝ Name
  let subjectMap = {};
  let techMap = {};
  let nonTechMap = {};

  // Load name maps first
  async function fetchPrerequisiteMap(type) {
  const res = await fetch(`/api/prerequisite-names?type=${type}`);
  const data = await res.json();
  const map = {};
  data.forEach(item => {
    map[item.id] = item.name;
  });
  return map;
}


  // Load all maps
 [subjectMap, techMap, nonTechMap] = await Promise.all([
  fetchPrerequisiteMap("subject"),
  fetchPrerequisiteMap("technical"),
  fetchPrerequisiteMap("non-technical")
]);

  // Now fetch fallback recommendation IDs
  fetchFallbackData();

  function fetchFallbackData() {
    const payload = {
      subjects: [174, 185, 195],
      technical_skills: [36, 40, 42, 35],
      non_technical_skills: [99, 100, 101],
      advanced_preferences: {
        training_modes: [1, 2],
        company_sizes: [2],
        industries: [3]
      },
      previous_fallback_ids: [1],
      is_fallback: true
    };

    fetch("https://train-track-backend.onrender.com/recommendations/fallback-prerequisites", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload)
    })
      .then(res => res.json())
      .then(data => {
        if (!data.success || !data.missing_prerequisites) {
          alert("⚠️ No fallback options returned.");
          return;
        }

        renderOptions(data.missing_prerequisites.subjects, subjectList, selectedSubjects, subjectMap);
        renderOptions(data.missing_prerequisites.technical_skills, technicalList, selectedTechSkills, techMap);
        renderOptions(data.missing_prerequisites.non_technical_skills, nonTechList, selectedNonTechSkills, nonTechMap);
      })
      .catch(err => {
        console.error("Error fetching fallback prerequisites:", err);
      });
  }

  // Selection tracking
  const selectedSubjects = new Set();
  const selectedTechSkills = new Set();
  const selectedNonTechSkills = new Set();

  function renderOptions(idArray, container, selectionSet, nameMap) {
    container.innerHTML = "";
    idArray.forEach(id => {
      const pill = document.createElement("div");
      pill.className = "pill";
      pill.textContent = nameMap[id] || `ID ${id}`;
      pill.onclick = () => {
        pill.classList.toggle("selected");
        if (selectionSet.has(id)) {
          selectionSet.delete(id);
        } else {
          selectionSet.add(id);
        }
      };
      container.appendChild(pill);
    });
  }

  // Final Submit
  submitBtn.addEventListener("click", function () {
    const finalPayload = {
      subjects: [...selectedSubjects],
      technical_skills: [...selectedTechSkills],
      non_technical_skills: [...selectedNonTechSkills],
      advanced_preferences: {
        training_modes: [1, 2],
        company_sizes: [2],
        industries: [3]
      },
      is_fallback: true
    };

    fetch("https://train-track-backend.onrender.com/recommendations", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(finalPayload)
    })
      .then(res => res.json())
      .then(result => {
        if (result.success && result.recommendations) {
          localStorage.setItem("fallbackResults", JSON.stringify(result.recommendations));
          window.location.href = "/summaryresults";
        } else {
          alert("❌ No match found after fallback.");
        }
      })
      .catch(err => console.error("Submit error:", err));
  });
});
