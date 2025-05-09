function technicalSkillsStep() {
  return {
    saveAndGoNext() {
      const checked = document.querySelectorAll('input[name="technical_skills[]"]:checked');
      const selected = Array.from(checked).map(cb => cb.value);

      if (selected.length < 3 || selected.length > 8) {
        alert("Please select between 3 and 8 technical skills.");
        return;
      }

      localStorage.setItem("selectedTechnicalSkills", JSON.stringify(selected));
      window.location.href = "/traintrack/nontechnical"; // ✅ Update this route
    }
  };
}

document.addEventListener('DOMContentLoaded', function () {
  const selectedIds = localStorage.getItem('selectedCategoryIds') || '';
  const savedSkillIds = JSON.parse(localStorage.getItem('selectedTechnicalSkills') || '[]');
  const container = document.getElementById('skills-container');
  const counterBox = document.getElementById('selected-counter');
  const selectedBox = document.getElementById('selected-skills-box');

  const emojiMap = {
    "Programming & Logic": "💻",
    "Cloud & DevOps Tools": "☁️",
    "Cybersecurity & IT Security": "🛡️",
    "Security & IT Operations": "🔒",
    "Database Technologies": "🗃️",
    "Web & UI Development": "🌐",
    "Software & System Design": "📐",
    "Testing & QA": "🔍",
    "IT & Business Process Management": "🧠",
    "Marketing Tools & Techniques": "🎯",
    "Digital Marketing Tools": "📢",
    "Data Analysis & BI Tools": "📊"
  };

  // 🧼 Set initial count
  updateCounter(savedSkillIds.length);

  axios.get(`https://train-track-backend.onrender.com/wizard/technical-skills?category_ids=${selectedIds}`)
    .then(res => {
      const data = res.data.data;

      data.forEach(subjectCategory => {
        subjectCategory.tech_categories.forEach(category => {
          const emoji = emojiMap[category.tech_category_name] || '📂';

          const box = document.createElement('div');
          box.className = 'category-box';

          const header = document.createElement('div');
          header.className = 'category-header';
          header.innerHTML = `<span>${emoji} ${category.tech_category_name}</span><span class="toggle-icon">+</span>`;

          const body = document.createElement('div');
          body.className = 'category-body';

          category.skills.forEach(skill => {
            const isChecked = savedSkillIds.includes(String(skill.id));
            const label = document.createElement('label');
            label.innerHTML = `
              <input type="checkbox" name="technical_skills[]" value="${skill.id}" ${isChecked ? 'checked' : ''}>
              ${skill.name}
            `;
            body.appendChild(label);
          });

          header.addEventListener('click', () => {
            body.classList.toggle('show');
            const icon = header.querySelector('.toggle-icon');
            icon.textContent = icon.textContent === '+' ? '−' : '+';
          });

          box.appendChild(header);
          box.appendChild(body);
          container.appendChild(box);
        });
      });

      attachCheckboxHandlers();
    })
    .catch(error => {
      container.innerHTML = '<p class="text-red-600">❌ Failed to load technical skills.</p>';
      console.error(error);
    });

  function attachCheckboxHandlers() {
    const checkboxes = document.querySelectorAll('input[name="technical_skills[]"]');

    function refreshUI() {
      const checked = document.querySelectorAll('input[name="technical_skills[]"]:checked');
      const selected = Array.from(checked).map(cb => ({
        id: cb.value,
        name: cb.parentElement.textContent.trim()
      }));

      // 💾 Save selected IDs
      localStorage.setItem('selectedTechnicalSkills', JSON.stringify(selected.map(s => s.id)));

      // 🔢 Update counter
      updateCounter(selected.length);

      // 🟣 Update selected pills
      selectedBox.innerHTML = '';
      selected.forEach(skill => {
        const pill = document.createElement('span');
        pill.className = 'skill-pill';
        pill.innerHTML = `
          <span class="pill-remove" data-id="${skill.id}">×</span>
          ${skill.name}
        `;
        selectedBox.appendChild(pill);
      });

      // ❌ Remove pill handler
      document.querySelectorAll('.pill-remove').forEach(btn => {
        btn.addEventListener('click', () => {
          const id = btn.getAttribute('data-id');
          const input = document.querySelector(`input[name="technical_skills[]"][value="${id}"]`);
          if (input) input.checked = false;
          refreshUI();
        });
      });

      // ✅ Enforce limit
      checkboxes.forEach(cb => {
        cb.disabled = !cb.checked && selected.length >= 8;
      });
    }

    checkboxes.forEach(cb => {
      cb.addEventListener('change', refreshUI);
    });

    refreshUI(); // Initialize
  }

  function updateCounter(count) {
    if (counterBox) {
      counterBox.textContent = `Selected: ${count}`;
    }
  }
});
