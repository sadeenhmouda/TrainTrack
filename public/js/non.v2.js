function nonTechnicalSkillsStep() {
  return {
    saveAndGoNext() {
      const checked = document.querySelectorAll('input[name="non_technical_skills[]"]:checked');
      const selectedIds = Array.from(checked).map(cb => cb.value);

      if (selectedIds.length < 3 || selectedIds.length > 5) {
        alert("Please select between 3 and 5 non-technical skills.");
        return;
      }

      // ✅ CORRECT KEY!
      localStorage.setItem("selectedNonTechnicalSkills", JSON.stringify(selectedIds));
      window.location.href = "/traintrack/advancepreferences";
    }
  };
}

document.addEventListener("DOMContentLoaded", function () {
  // ✅ Use only this correct key here too
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

    // ✅ Store with the correct key again
    localStorage.setItem("selectedNonTechnicalSkills", JSON.stringify(selectedIds));
    if (counter) counter.textContent = `Selected: ${selectedIds.length}`;

    // Highlight selected
    checkboxes.forEach(cb => {
      cb.parentElement.classList.toggle("selected", cb.checked);
    });

    // Limit max selection
    checkboxes.forEach(cb => {
      cb.disabled = !cb.checked && selectedIds.length >= 5;
    });

    // Enable Next button if valid
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

  // ✅ Activate next
  const vm = nonTechnicalSkillsStep();
  nextBtn?.addEventListener("click", vm.saveAndGoNext);
});
