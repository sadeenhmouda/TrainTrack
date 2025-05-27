function nonTechnicalSkillsStep() {
  return {
    saveAndGoNext() {
      const checked = document.querySelectorAll('input[name="non_technical_skills[]"]:checked');
      const selectedIds = Array.from(checked).map(cb => cb.value);

      if (selectedIds.length < 3 || selectedIds.length > 5) {
        Swal.fire({
          icon: 'warning',
          title: 'Oops! 😅',
          text: 'Please select between 3 and 5 soft skills before continuing.',
          confirmButtonText: 'Okay!',
          confirmButtonColor: '#6A1B9A',
          background: '#F8F0FF',
          color: '#333'
        });
        return;
      }

      localStorage.setItem("selectedNonTechnicalSkills", JSON.stringify(selectedIds));
      window.location.href = "/traintrack/advancepreferences";
    }
  };
}

document.addEventListener("DOMContentLoaded", function () {
  const savedSkillIds = JSON.parse(localStorage.getItem("selectedNonTechnicalSkills") || "[]");
  const skillContainer = document.getElementById("skills-container");
  const counter = document.getElementById("nontech-counter");
  const nextBtn = document.getElementById("nextBtn");

  const apiURL = "https://train-track-backend.onrender.com/wizard/non-technical-skills";

  const emojiMap = {
    "Adaptability": "💡",
    "Collaboration": "🤝",
    "Creativity": "🎨",
    "Critical Thinking": "🎯",
    "Customer Service": "💬",
    "Detailed oriented": "👀",
    "Effective Communication": "💭",
    "Leadership": "👑",
    "Organizational Skills": "📂",
    "Presentation Skills": "🧑‍🏫",
    "Problem-Solving": "🧠",
    "Strategic Thinking": "🧍‍♂️",
    "Teamwork": "👥",
    "Time Management": "⏳",
    "Typing Speed & Accuracy": "⌨️",
    "User-Centered Thinking": "🧑‍💻"
  };

  fetch(apiURL)
    .then(response => response.json())
    .then(result => {
      if (result.success && Array.isArray(result.data)) {
        skillContainer.innerHTML = "";

        result.data.forEach(skill => {
          const emoji = emojiMap[skill.name] || "🧩";

          const wrapper = document.createElement("label");
          wrapper.className = "skill-card";
          wrapper.innerHTML = `
            <input type="checkbox" name="non_technical_skills[]" value="${skill.id}">
            <span class="emoji">${emoji}</span>
            ${skill.name}
          `;
          skillContainer.appendChild(wrapper);
        });

        const checkboxes = document.querySelectorAll('input[name="non_technical_skills[]"]');

        // ✅ Restore previously selected
        savedSkillIds.forEach(id => {
          const input = document.querySelector(`input[name="non_technical_skills[]"][value="${id}"]`);
          if (input) input.checked = true;
        });

        // ✅ Block the 6th selection
        checkboxes.forEach(cb => {
          cb.addEventListener("pointerdown", (e) => {
            const checkedCount = document.querySelectorAll('input[name="non_technical_skills[]"]:checked').length;

            if (!cb.checked && checkedCount >= 5) {
              e.preventDefault(); // stop toggle

              Swal.fire({
                icon: 'info',
                title: 'Limit reached 😊',
                text: 'You can only select up to 5 soft skills.',
                confirmButtonText: 'Got it!',
                confirmButtonColor: '#6A1B9A',
                background: '#F8F0FF',
                color: '#333'
              });
            }
          });
        });

        // ✅ Update counter, button state, and styling
        checkboxes.forEach(cb => {
          cb.addEventListener("change", updateUI);
        });

        updateUI();
      }
    })
    .catch(error => {
      console.error("❌ Failed to fetch non-technical skills:", error);
    });

  function updateUI() {
    const checkboxes = document.querySelectorAll('input[name="non_technical_skills[]"]');
    const checked = Array.from(checkboxes).filter(cb => cb.checked);
    const selectedIds = checked.map(cb => cb.value);

    localStorage.setItem("selectedNonTechnicalSkills", JSON.stringify(selectedIds));
    if (counter) counter.textContent = `Selected: ${selectedIds.length}`;

    checkboxes.forEach(cb => {
      cb.parentElement.classList.toggle("selected", cb.checked);
    });

    checkboxes.forEach(cb => {
      cb.disabled = !cb.checked && selectedIds.length >= 5;
    });

    if (nextBtn) {
      if (selectedIds.length >= 3 && selectedIds.length <= 5) {
        nextBtn.classList.add("active");
        nextBtn.disabled = false;
      } else {
        nextBtn.classList.remove("active");
        nextBtn.disabled = true;
      }
    }
  }

  const vm = nonTechnicalSkillsStep();
  nextBtn?.addEventListener("click", vm.saveAndGoNext);
});
