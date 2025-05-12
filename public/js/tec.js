function technicalSkillsStep() {
  return {
    saveAndGoNext() {
      const checked = document.querySelectorAll('input[name="technical_skills[]"]:checked');
      let selected = Array.from(checked).map(cb => cb.value);
      selected = [...new Set(selected)];

      if (selected.length < 3 || selected.length > 8) {
        alert("Please select between 3 and 8 technical skills.");
        return;
      }

      localStorage.setItem("selectedTechnicalSkills", JSON.stringify(selected));
      window.location.href = "/traintrack/nontechnical";
    }
  };
}

document.addEventListener("DOMContentLoaded", function () {
  const selectedIds = JSON.parse(localStorage.getItem("selectedTechnicalSkills") || "[]");
  const counter = document.getElementById("selected-counter");
  const selectedBox = document.getElementById("selected-skills-box");
  const skillContainer = document.getElementById("technical-skills-list");

  // ✅ Emoji map for category headers
  const emojiMap = {
    "Programming & Logic": "🛠️",
    "Cloud & DevOps Tools": "☁️",
    "Security & IT Operations": "🔒",
    "Database Technologies": "🗃️",
    "Web & UI Development": "🌐",
    "Software & System Design": "📐",
    "Testing & QA": "🔍",
    "IT & Business Process Management": "📊",
    "Digital Marketing Tools": "📣",
    "Marketing Tools & Techniques": "🎯",
    "Data Analysis & BI Tools": "📈",
    "Cybersecurity & IT Security": "🛡️"
  };

  const apiURL = "https://train-track-backend.onrender.com/wizard/technical-skills?category_ids=11,12,13,14,15,16,17,18";

  fetch(apiURL)
    .then(response => response.json())
    .then(result => {
      if (result.success && Array.isArray(result.data)) {
        skillContainer.innerHTML = "";

        // ✅ Flatten tech categories from all subject categories
        const allTechCategories = [];

        result.data.forEach(subjectCategory => {
          subjectCategory.tech_categories.forEach(techCat => {
            allTechCategories.push({
              name: techCat.tech_category_name,
              skills: techCat.skills
            });
          });
        });

        // ✅ Group by unique tech category names
        const grouped = {};
        allTechCategories.forEach(cat => {
          if (!grouped[cat.name]) grouped[cat.name] = [];
          grouped[cat.name] = grouped[cat.name].concat(cat.skills);
        });

        // ✅ Render each tech category with collapsible section
        Object.entries(grouped).forEach(([categoryName, skills]) => {
          const emoji = emojiMap[categoryName] || "";
          const categoryBox = document.createElement("div");
          categoryBox.className = "category-box";

          categoryBox.innerHTML = `
            <div class="category-header">
              ${emoji} ${categoryName}
              <span class="toggle-icon">+</span>
            </div>
            <div class="category-body">
              ${skills.map(skill => `
                <label>
                  <input type="checkbox" name="technical_skills[]" value="${skill.id}">
                  ${skill.name}
                </label>
              `).join("")}
            </div>
          `;

          skillContainer.appendChild(categoryBox);
        });

        // ✅ Handle collapsible toggle
        document.querySelectorAll(".category-header").forEach(header => {
          header.addEventListener("click", () => {
            const body = header.nextElementSibling;
            const icon = header.querySelector(".toggle-icon");
            body.classList.toggle("show");
            icon.textContent = body.classList.contains("show") ? "-" : "+";
          });
        });

        // ✅ Pre-select saved skills
        selectedIds.forEach(id => {
          const input = document.querySelector(`input[name="technical_skills[]"][value="${id}"]`);
          if (input) input.checked = true;
        });

        document.querySelectorAll('input[name="technical_skills[]"]').forEach(cb => {
          cb.addEventListener("change", updateUI);
        });

        updateUI();
      }
    })
    .catch(error => {
      console.error("❌ Failed to load technical skills:", error);
    });

  function updateUI() {
    const checked = document.querySelectorAll('input[name="technical_skills[]"]:checked');
    let selected = Array.from(checked).map(cb => ({
      id: cb.value,
      name: cb.parentElement.textContent.trim()
    }));

    selected = selected.filter((s, index, self) => index === self.findIndex(t => t.id === s.id));
    localStorage.setItem("selectedTechnicalSkills", JSON.stringify(selected.map(s => s.id)));

    if (counter) counter.textContent = `Selected: ${selected.length}`;

    if (selectedBox) {
      selectedBox.innerHTML = "";
      selected.forEach(skill => {
        const pill = document.createElement("span");
        pill.className = "skill-pill";
        pill.innerHTML = `<span class="pill-remove" data-id="${skill.id}">×</span>${skill.name}`;
        selectedBox.appendChild(pill);
      });
    }

    document.querySelectorAll(".pill-remove").forEach(btn => {
      btn.addEventListener("click", () => {
        const id = btn.getAttribute("data-id");
        const input = document.querySelector(`input[name="technical_skills[]"][value="${id}"]`);
        if (input) input.checked = false;
        updateUI();
      });
    });

    const checkboxes = document.querySelectorAll('input[name="technical_skills[]"]');
    checkboxes.forEach(cb => {
      cb.disabled = !cb.checked && selected.length >= 8;
    });
  }
});
