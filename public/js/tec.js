const userId = localStorage.getItem("userId");
if (!userId) {
  console.warn("⚠️ No user ID found in localStorage");
}function technicalSkillsStep() {
  return {
    saveAndGoNext() {
      const checked = document.querySelectorAll('input[name="technical_skills[]"]:checked');
      let selected = Array.from(checked).map(cb => cb.value);
      selected = [...new Set(selected)];

      if (selected.length < 3 || selected.length > 8) {
        Swal.fire({
          icon: 'warning',
          title: 'Oops! 😅',
          text: 'Please select between 3 and 8 technical skills.',
          confirmButtonColor: '#6A1B9A',
          background: '#F8F0FF',
          color: '#333'
        });
        return;
      }

      localStorage.setItem("selectedTechnicalSkills", JSON.stringify(selected));
      window.location.href = "/traintrack/nontechnical";
    }
  };
}

document.addEventListener("DOMContentLoaded", function () {
  const selectedIds = JSON.parse(localStorage.getItem("selectedTechnicalSkills") || "[]");
  const selectedCategoryIds = JSON.parse(localStorage.getItem("selectedSubjectCategoryIds") || "[]");
  const counter = document.getElementById("selected-counter");
  const selectedBox = document.getElementById("selected-skills-box");
  const skillContainer = document.getElementById("technical-skills-list");

  const emojiMap = {
    "programming & logic": "🛠️",
    "cloud & devops tools": "☁️",
    "cybersecurity & it security": "🔒",
    "data analysis & bi tools": "📈",
    "software & system design": "📐",
    "web & ui development": "🌐",
    "testing & qa": "🔍",
    "it & business process management": "📊",
    "marketing tools & techniques": "🎯",
    "digital marketing tools": "📣"
  };

  if (!selectedCategoryIds.length) {
    skillContainer.innerHTML = `<p style="color:red;">❌ No subject categories selected. Please go back and choose topics first.</p>`;
    return;
  }

  const apiURL = `https://train-track-backend.onrender.com/wizard/technical-skills?category_ids=${selectedCategoryIds.join(",")}`;
  console.log("📡 Fetching:", apiURL);

  fetch(apiURL)
    .then(res => res.json())
    .then(result => {
      console.log("✅ API Result:", result);

      if (result.success && Array.isArray(result.data)) {
        const grouped = {};

        result.data.forEach(subjectCategory => {
          subjectCategory.tech_categories.forEach(techCat => {
            const categoryName = techCat.tech_category_name;
            if (!grouped[categoryName]) grouped[categoryName] = new Map();
            techCat.skills.forEach(skill => {
              grouped[categoryName].set(skill.id, skill);
            });
          });
        });

        skillContainer.innerHTML = "";

        Object.entries(grouped).forEach(([categoryName, skillMap]) => {
          const emoji = emojiMap[categoryName.toLowerCase()] || "";
          const skills = Array.from(skillMap.values());

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

        // ✅ Toggle logic
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

        // ✅ Add listener to enforce max limit with popup
        document.querySelectorAll('input[name="technical_skills[]"]').forEach(cb => {
          cb.addEventListener("change", (e) => {
            const checked = document.querySelectorAll('input[name="technical_skills[]"]:checked');
            if (checked.length > 8) {
              cb.checked = false;
              Swal.fire({
                 icon: 'info',
                 title: 'Limit reached 😊', 
                 text: 'You can only select up to 8 technical skills.',
                 confirmButtonText: 'Got it!',
                 confirmButtonColor: '#6A1B9A',     // your purple brand color
                 background: '#F8F0FF',             // soft background
                 color: '#333'
              });
            } else {
              updateUI();
            }
          });
        });

        updateUI();
      } else {
        skillContainer.innerHTML = `<p style="color:red;">⚠️ No skills found for selected categories.</p>`;
      }
    })
    .catch(err => {
      console.error("❌ Fetch error:", err);
      skillContainer.innerHTML = `<p style="color:red;">❌ Error loading skills.</p>`;
    });

  function updateUI() {
    const checked = document.querySelectorAll('input[name="technical_skills[]"]:checked');
    let selected = Array.from(checked).map(cb => ({
      id: cb.value,
      name: cb.parentElement.textContent.trim()
    }));

    selected = selected.filter((s, i, self) => i === self.findIndex(t => t.id === s.id));
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
  }
});
