document.addEventListener("DOMContentLoaded", function () {
  const container = document.getElementById("positionResultsContainer");
  const fallbackTriggered = localStorage.getItem("fallbackTriggered");
  const finalWizardData = localStorage.getItem("finalWizardData");

  if (!finalWizardData) {
    showError("Wizard data missing. Please restart the wizard.");
    return;
  }

  fetch("https://train-track-backend.onrender.com/recommendations", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: finalWizardData
  })
    .then(res => res.json())
    .then(async result => {
      console.log("🎯 Recommendation result:", result);

      if (!result.success || !Array.isArray(result.recommended_positions)) {
        throw new Error("No valid recommendations returned.");
      }

      localStorage.setItem("recommendationResult", JSON.stringify(result));

      if (result.should_fetch_companies) {
        const ids = result.recommended_positions.map(p => p.position_id).join(",");

        const raw = result.company_filter_ids || {
          training_mode: null,
          company_size: null,
          preferred_industry: [],
          company_culture: []
        };

        const f = {
          training_modes: raw.training_mode ? [raw.training_mode].flat() : [],
          company_sizes: raw.company_size ? [raw.company_size].flat() : [],
          industries: raw.preferred_industry || [],
          cultures: raw.company_culture || []
        };

        let url = `https://train-track-backend.onrender.com/companies-for-positions?ids=${ids}`;
        if (f.training_modes.length > 0) url += `&training_modes=${f.training_modes.join(",")}`;
        if (f.company_sizes.length > 0) url += `&company_sizes=${f.company_sizes.join(",")}`;
        if (f.industries.length > 0) url += `&industries=${f.industries.join(",")}`;
        if (f.cultures.length > 0) url += `&company_culture=${f.cultures.join(",")}`;

        console.log("🏢 Fetching companies with URL:", url);

        const companyRes = await fetch(url);
        const companyData = await companyRes.json();

        if (companyData.success && Array.isArray(companyData.companies)) {
          result.companies = companyData.companies;
        }
      }

      renderSummary(result);
    })
    .catch(err => {
      console.error("❌ API error. Falling back to cached result:", err);

      const stored = localStorage.getItem("recommendationResult");
      let cached = null;
      try {
        cached = stored ? JSON.parse(stored) : null;
      } catch (err) {
        return showError("Invalid cached result. Please restart the wizard.");
      }

      if (!cached || !cached.success) {
        return showError("No valid results. Please restart the wizard.");
      }

      renderSummary(cached);
    });

  function showError(msg) {
    Swal.fire("Error", msg, "error").then(() => {
      window.location.href = "/traintrack";
    });
  }

  function renderSummary(result) {
    if (result.match_scenario === "fallback") {
      showFallbackModal();
    }

    result.recommended_positions.forEach((pos, index) => {
      const card = document.createElement("div");
      card.className = "position-card";

      card.innerHTML = `
        <div class="card-top">
          <div class="circular-progress" id="progress-${index}">
            <span class="progress-value">0%</span>
          </div>
          <div>
            <p class="track-text">💼 You're on track for:</p>
            <h3 class="position-name">${pos.position_name}</h3>
          </div>
        </div>

        <!-- Everything below is hidden initially -->
        <div class="card-details" style="display: none">

          <div class="match-breakdown">
            <div class="bar-label">Subject Match <span>${pos.subject_fit_percentage.toFixed(1)}%</span></div>
            <div class="bar-container"><div class="bar" id="subject-${index}"></div></div>

            <div class="bar-label">Technical Skill <span>${pos.technical_skill_fit_percentage.toFixed(1)}%</span></div>
            <div class="bar-container"><div class="bar" id="tech-${index}"></div></div>

            <div class="bar-label">Non-Technical Skill <span>${pos.non_technical_skill_fit_percentage.toFixed(1)}%</span></div>
            <div class="bar-container"><div class="bar" id="nontech-${index}"></div></div>
          </div>

          <button class="read-more-btn">💼 Read More About the Position</button>

          <div class="company-section" id="companies-${index}"></div>

          <button class="toggle-more-btn">Show Less ▲</button>
        </div>

        <!-- Show More toggle always visible -->
        <button class="toggle-more-btn show-more-btn" data-index="${index}">Show More ▼</button>
      `;

      container.appendChild(card);

      // Render progress bars
      renderCircularProgress(`progress-${index}`, pos.match_score_percentage);
      renderLinearProgress(`subject-${index}`, pos.subject_fit_percentage);
      renderLinearProgress(`tech-${index}`, pos.technical_skill_fit_percentage);
      renderLinearProgress(`nontech-${index}`, pos.non_technical_skill_fit_percentage);
    });

    // Toggle Show More / Less
    container.addEventListener("click", function (e) {
      if (e.target.classList.contains("show-more-btn")) {
        const card = e.target.closest(".position-card");
        card.querySelector(".card-details").style.display = "block";
        e.target.style.display = "none";
      }

      if (e.target.classList.contains("toggle-more-btn") && !e.target.classList.contains("show-more-btn")) {
        const card = e.target.closest(".position-card");
        card.querySelector(".card-details").style.display = "none";
        const showMoreBtn = card.querySelector(".show-more-btn");
        if (showMoreBtn) showMoreBtn.style.display = "inline-block";
      }
    });

    if (result.companies) {
      renderCompanies(result.companies, result.recommended_positions);
    }

    if (fallbackTriggered === "true") {
      const improveDiv = document.createElement("div");
      improveDiv.innerHTML = `
        <div style="text-align: center; margin-top: 2rem;">
          <button id="improveBtn" style="
            background: linear-gradient(90deg, #8e2de2, #4a00e0);
            color: white;
            border: none;
            padding: 14px 28px;
            font-size: 16px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
          ">✨ Improve My Selections</button>
        </div>
      `;
      container.appendChild(improveDiv);

      document.getElementById("improveBtn").addEventListener("click", () => {
        localStorage.removeItem("fallbackTriggered");
        window.location.href = "/traintrack/fallback/improve";
      });
    }
  }

  function renderCircularProgress(id, percent) {
    const el = document.getElementById(id);
    if (!el) return;
    el.style.background = `conic-gradient(orange ${percent}%, #e0e0e0 ${percent}%)`;
    el.querySelector(".progress-value").textContent = `${Math.round(percent)}%`;
  }

  function renderLinearProgress(id, percent) {
    const el = document.getElementById(id);
    if (!el) return;
    el.style.width = `${percent}%`;
  }

  function renderCompanies(companies, positions) {
    positions.forEach((pos, index) => {
      const compContainer = document.getElementById(`companies-${index}`);
      const filtered = companies.filter(c => c.position_id === pos.position_id);

      if (filtered.length > 0) {
        compContainer.innerHTML = "<p><strong>Based on your preferences, you fit in:</strong></p>";
        filtered.forEach((c, i) => {
          compContainer.innerHTML += `
            <p>
              ${i + 1}. ${c.company_name}<br>
              📍 ${c.location} | 🏛 ${c.industry} | 🏢 ${c.company_size}
            </p>
          `;
        });
      }
    });
  }
});

function restartWizard() {
  const keys = [
    "fullName", "gender", "majorId", "dateOfBirth",
    "selectedSubjectIds", "selectedTechnicalSkills", "selectedNonTechnicalSkills",
    "trainingModeId", "trainingModeDesc", "companySizeId", "companySizeDesc",
    "industryIds", "selectedIndustryNames", "companyCulture", "cultureMap",
    "recommendationResult", "fallbackTriggered", "finalWizardData"
  ];

  keys.forEach(k => localStorage.removeItem(k));
  window.location.href = "/traintrack";
}
