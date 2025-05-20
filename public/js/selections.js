document.addEventListener("DOMContentLoaded", function () {
  // ✅ Remove duplicates
  function uniqueArray(arr) {
    return [...new Set(arr || [])];
  }

  // ✅ Safe JSON parsing
  function safeParse(key) {
    try {
      return JSON.parse(localStorage.getItem(key));
    } catch {
      return null;
    }
  }

  const personal = safeParse("personal_info") || {};

  // ✅ Inject single values
  document.getElementById("fullName").textContent = personal.full_name || "N/A";
  document.getElementById("gender").textContent = personal.gender || "N/A";
  document.getElementById("major").textContent = personal.major || "N/A";
  document.getElementById("dob").textContent = personal.date_of_birth || "N/A";
  document.getElementById("trainingMode").textContent = personal.training_mode || personal.trainingModeName || "N/A";
  document.getElementById("companySize").textContent = personal.company_size || personal.companySizeName || "N/A";

  // ✅ Reusable function for rendering lists
  function renderListFromPersonal(id, key) {
    const list = Array.isArray(personal[key]) ? uniqueArray(personal[key]) : [];
    const container = document.getElementById(id);
    container.innerHTML = "";
    list.forEach(item => {
      const li = document.createElement("li");
      li.textContent = item;
      container.appendChild(li);
    });
  }

<<<<<<< HEAD
  function renderListFromStorage(id, key) {
    const list = safeParse(key);
    const container = document.getElementById(id);
    container.innerHTML = "";
    if (Array.isArray(list)) {
      uniqueArray(list).forEach(item => {
        const li = document.createElement("li");
        li.textContent = item;
        container.appendChild(li);
      });
    }
  }

  // ✅ Render lists from localStorage
  renderListFromStorage("subjectList", "selectedSubjectNames");
  renderListFromStorage("technicalSkillList", "selectedTechnicalSkills");
  renderListFromStorage("nonTechnicalSkillList", "selectedNonTechnicalSkills");
  renderListFromPersonal("cultureList", "preferred_cultures");
  renderListFromPersonal("industryList", "preferred_industries");
=======
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
>>>>>>> 4a066e589694056365294e7326738d9a0487cc99
});
