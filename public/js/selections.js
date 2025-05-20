document.addEventListener("DOMContentLoaded", function () {
  const payload = localStorage.getItem("finalWizardData");

  if (!payload) {
    alert("⚠️ No saved wizard data found. Please complete the wizard first.");
    return;
  }

  fetch("https://train-track-backend.onrender.com/user-input-summary", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: payload
  })
    .then(res => res.json())
    .then(result => {
      if (!result.success) throw new Error("Failed to fetch summary");

      const data = result.data;

      // ✅ Show content and hide spinner
      document.getElementById("loadingSpinner").style.display = "none";
      document.getElementById("selectionContent").style.display = "block";

      // ✅ Basic Info
      showIfExists("fullName", data.full_name);
      showIfExists("gender", data.gender);
      showIfExists("major", data.major);
      showIfExists("dob", data.date_of_birth);

      // ✅ Grouped Lists (Subjects, Tech Skills)
      toggleGroupedList("subjectList", data.subjects, "subjects");
      toggleGroupedList("technicalSkillList", data.technical_skills, "skills");

      // ✅ Flat List (Non-Technical Skills)
      toggleFlatList("nonTechnicalSkillList", data.non_technical_skills);

      // ✅ Optional Preferences
      const prefs = data.preferences || {};

      showIfExists("trainingMode", prefs.training_mode_name, "trainingModeCard");
      showIfExists("companySize", prefs.company_size_name, "companySizeCard");
      toggleFlatList("cultureList", prefs.company_culture_names, "cultureCard");
      toggleFlatList("industryList", prefs.preferred_industry_names, "industryCard");
    })
    .catch(err => {
      console.error("❌ Error loading selections:", err);
      alert("Something went wrong while loading your selections.");
    });

  function showIfExists(spanId, value, wrapperId = null) {
    const span = document.getElementById(spanId);
    const wrapper = wrapperId ? document.getElementById(wrapperId) : span.closest(".info-card");

    if (value) {
      span.textContent = value;
      wrapper.style.display = wrapper.classList.contains("inline-pair") ? "flex" : "block";
    } else {
      wrapper.style.display = "none";
    }
  }

  function toggleGroupedList(id, groups, key) {
    const container = document.getElementById(id);
    container.innerHTML = "";

    if (!groups || groups.length === 0) {
      container.closest(".info-card").style.display = "none";
      return;
    }

    groups.forEach(group => {
      const li = document.createElement("li");
      const names = group[key].map(item => item.name).join(", ");
      li.innerHTML = `<span style="font-weight: 600; color: #3a2257;">${group.category_name}:</span> ${names}`;
      container.appendChild(li);
    });
  }

  function toggleFlatList(containerId, items, wrapperId = null) {
    const container = document.getElementById(containerId);
    const wrapper = wrapperId ? document.getElementById(wrapperId) : container.closest(".info-card");
    container.innerHTML = "";

    if (!items || items.length === 0) {
      wrapper.style.display = "none";
      return;
    }

    items.forEach(item => {
      const li = document.createElement("li");
      li.textContent = item;
      container.appendChild(li);
    });

    wrapper.style.display = "block";
  }
});
