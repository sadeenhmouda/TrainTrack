document.addEventListener("DOMContentLoaded", function () {
  const container = document.getElementById("positionResultsContainer");

  // ✅ Load recommendation result from localStorage
  const stored = localStorage.getItem("recommendationResult");
  const result = stored ? JSON.parse(stored) : null;

  if (!result || result.success !== true) {
    showError("Something went wrong. Please try again.");
    return;
  }

  // ❌ NO MATCH
  if (!result.recommended_positions || result.recommended_positions.length === 0) {
    Swal.fire({
      icon: "error",
      title: "No Match",
      html: `
        <p>Don’t worry—sometimes things don’t go as planned, and that’s totally okay! ✨</p>
        <p>This is just one step in your journey, and every great success story has a few bumps along the way.</p>
        <p>Take a deep breath, keep your head up, and let’s try again.</p>
        <strong>👉 Click “Repeat the Wizard” when you're ready—we believe in you! 💪</strong>
      `,
      confirmButtonText: "🔁 Repeat the Wizard",
      customClass: {
        popup: 'no-match-popup'
      },
      backdrop: true
    }).then(() => {
      // ✅ Clear wizard answers
      localStorage.removeItem("selectedSubjectIds");
      localStorage.removeItem("selectedTechnicalSkills");
      localStorage.removeItem("selectedNonTechnicalSkills");
      localStorage.removeItem("trainingModeId");
      localStorage.removeItem("companySizeId");
      localStorage.removeItem("industryIds");
      localStorage.removeItem("recommendationResult");
      localStorage.removeItem("fallbackTriggered");

      // ✅ Redirect to wizard start
      window.location.href = "/traintrack";
    });
    return;
  }

  // ✅ NORMAL MATCH SCENARIOS (Perfect, Very Strong, Strong, Partial, Fallback)
  result.recommended_positions.forEach((pos, index) => {
    const card = document.createElement("div");
    card.className = "position-card";
    card.innerHTML = `
      <div class="card-top">
        <p class="track-text">💼 You're on track for:</p>
        <h3 class="position-name">${pos.position_name}</h3>
        <div class="match-badge">${pos.fit_level} (${pos.match_score_percentage.toFixed(1)}%)</div>
        <button class="show-more-btn" data-index="${index}">Show More ▼</button>
      </div>

      <div class="card-details" style="display: none">
        <div class="match-breakdown">
          <p>Subject Match: ${pos.subject_fit_percentage.toFixed(1)}%</p>
          <p>Technical Skill: ${pos.technical_skill_fit_percentage.toFixed(1)}%</p>
          <p>Non-Technical Skill: ${pos.non_technical_skill_fit_percentage.toFixed(1)}%</p>
        </div>
        <div class="company-section" id="companies-${index}"></div>
        <button class="show-less-btn">Show Less ▲</button>
      </div>
    `;
    container.appendChild(card);
  });

  // 🔄 Show/Hide Details Toggle
  container.addEventListener("click", function (e) {
    if (e.target.classList.contains("show-more-btn")) {
      const card = e.target.closest(".position-card");
      card.querySelector(".card-details").style.display = "block";
      e.target.style.display = "none";
    }
    if (e.target.classList.contains("show-less-btn")) {
      const card = e.target.closest(".position-card");
      card.querySelector(".card-details").style.display = "none";
      card.querySelector(".show-more-btn").style.display = "inline-block";
    }
  });

  // ✅ Company Matching (if enabled)
  if (result.should_fetch_companies && result.companies) {
    result.recommended_positions.forEach((pos, index) => {
      const compContainer = document.getElementById(`companies-${index}`);
      const matching = result.companies || [];
      if (matching.length > 0) {
        compContainer.innerHTML = "<p><strong>Based on your preferences, you fit in:</strong></p>";
        matching.forEach((c, i) => {
          compContainer.innerHTML += `
            <p>
              ${i + 1}. ${c.company_name}<br>
              📍 ${c.location} | 🏭 ${c.industry} | 🏢 ${c.company_size}
            </p>
          `;
        });
      }
    });
  }
});

// 🔧 Error Helper
function showError(msg) {
  Swal.fire("Error", msg, "error");
}
