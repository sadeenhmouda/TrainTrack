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
        window.location.href = "/traintrack/nontechnical"; // Update with actual route
      }
    };
  }
  
  document.addEventListener('DOMContentLoaded', function () {
    const selectedIds = localStorage.getItem('selectedCategoryIds') || '';
    const selectedSkillIds = JSON.parse(localStorage.getItem('selectedTechnicalSkills') || '[]');
    const container = document.getElementById('skills-container');
  
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
              const isChecked = selectedSkillIds.includes(String(skill.id)) ? 'checked' : '';
              const label = document.createElement('label');
              label.innerHTML = `
                <input type="checkbox" name="technical_skills[]" value="${skill.id}" ${isChecked}>
                ${skill.name}
              `;
              body.appendChild(label);
            });
  
            // Toggle logic
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
      })
      .catch(error => {
        container.innerHTML = '<p class="text-red-600">❌ Failed to load technical skills.</p>';
        console.error(error);
      });
  });
  