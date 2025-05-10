function nonTechnicalSkillsStep() {
    return {
      selectedSkills: JSON.parse(localStorage.getItem('selectedNonTechSkills'))?.skills || [],
  
      saveAndGoNext() {
        if (this.selectedSkills.length >= 3 && this.selectedSkills.length <= 5) {
          localStorage.setItem('selectedNonTechSkills', JSON.stringify({
            skills: this.selectedSkills
          }));
          window.location.href = "/traintrack/advancepreferences";
        }
      }
    };
  }
  
  document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('skills-container');
    const nextBtn = document.getElementById('nextBtn');
  
    // 🚫 Step validation — check if previous step was done
    const categoryIds = localStorage.getItem("selectedCategoryIds");
    if (!categoryIds) {
      container.innerHTML = "<p class='alert-warning'>⚠️ Please go back and complete the previous steps first.</p>";
      nextBtn.disabled = true;
      return;
    }
  
    // ✅ Reset saved skills only once per session
    const isReturning = sessionStorage.getItem('wizard_in_progress');
    if (!isReturning) {
      localStorage.removeItem('selectedNonTechSkills');
      sessionStorage.setItem('wizard_in_progress', 'true');
    }
  
    // Load previously selected skills
    const selectedSkillObj = JSON.parse(localStorage.getItem('selectedNonTechSkills') || '{}');
    const selectedSkillIds = selectedSkillObj.skills || [];
  
    const emojiMap = {
      "Problem-Solving": "💻",
      "Strong Problem-Solving": "🍀",
      "Effective Communication": "💬",
      "Ability to Work in a Team": "🤝",
      "Time Management": "⏳",
      "Attention to Detail": "👀",
      "Organizational Skills": "📑",
      "Leadership": "🗂️",
      "Strategic Thinking": "♟️",
      "Interpersonal Skills": "🏆",
      "Logical & Critical Thinking": "🧠",
      "Creativity": "🎨",
      "Confidentiality": "🔒",
      "User-Centric Thinking": "🧍",
      "Customer Service Skills": "💡",
      "Adaptability": "🌊",
      "Collaboration": "🤝",
      "Critical Thinking": "🎯",
      "Detailed oriented": "🔍",
      "Presentation Skills": "📽️",
      "Typing Speed & Accuracy": "⌨️"
    };
  
    axios.get("https://train-track-backend.onrender.com/wizard/non-technical-skills")
      .then(response => {
        const skills = response.data.data;
  
        skills.forEach(skill => {
          const isChecked = selectedSkillIds.includes(String(skill.id));
          const emoji = emojiMap[skill.name] || '';
  
          const label = document.createElement('label');
          label.className = 'skill-card';
          label.innerHTML = `
            <input type="checkbox" value="${skill.id}" ${isChecked ? 'checked' : ''}>
            <span>${emoji} ${skill.name}</span>
          `;
  
          const checkbox = label.querySelector('input');
          checkbox.addEventListener('change', (e) => {
            const id = e.target.value;
  
            if (e.target.checked) {
              if (selectedSkillIds.length >= 5) {
                e.target.checked = false;
                alert("You can only select up to 5 skills.");
                return;
              }
              selectedSkillIds.push(id);
            } else {
              const index = selectedSkillIds.indexOf(id);
              if (index !== -1) selectedSkillIds.splice(index, 1);
            }
  
            localStorage.setItem('selectedNonTechSkills', JSON.stringify({ skills: selectedSkillIds }));
            document.querySelector('.selection-counter').textContent = `Selected ${selectedSkillIds.length}`;
  
            // Enable/Disable Next button
            const isValid = selectedSkillIds.length >= 3 && selectedSkillIds.length <= 5;
            nextBtn.disabled = !isValid;
            nextBtn.classList.toggle('active', isValid);
          });
  
          container.appendChild(label);
        });
  
        // Set initial counter
        document.querySelector('.selection-counter').textContent = `Selected ${selectedSkillIds.length}`;
  
        // Set initial button state
        const isValid = selectedSkillIds.length >= 3 && selectedSkillIds.length <= 5;
        nextBtn.disabled = !isValid;
        nextBtn.classList.toggle('active', isValid);
      })
      .catch(error => {
        console.error("API Error:", error);
        container.innerHTML = `<p class="alert-warning">❌ Failed to load skills. Please try again later.</p>`;
      });
  
    // Style toggle on Back button
    const backBtn = document.getElementById('backBtn');
    if (backBtn) {
      backBtn.addEventListener('click', () => {
        backBtn.classList.toggle('bg-[#6A1B9A]');
        backBtn.classList.toggle('text-white');
        backBtn.classList.toggle('border-none');
      });
    }
  
    // ✅ Next button click handler
    nextBtn.addEventListener('click', () => {
      const selectedSkillObj = JSON.parse(localStorage.getItem('selectedNonTechSkills') || '{}');
      const selectedSkillIds = selectedSkillObj.skills || [];
      if (selectedSkillIds.length >= 3 && selectedSkillIds.length <= 5) {
        window.location.href = "/traintrack/advancepreferences";
      }
    });
  });
  