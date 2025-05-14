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
      if (!result.success || !Array.isArray(result.recommended_positions)) {
        throw new Error("No valid recommendations returned.");
      }

      localStorage.setItem("recommendationResult", JSON.stringify(result));
      renderSummary(result);

      // ✅ Dynamically fetch matched companies using available filters
      if (result.should_fetch_companies && result.company_filter_ids) {
        const ids = result.recommended_positions.map(p => p.position_id).join(",");
        const f = result.company_filter_ids;

        let url = `https://train-track-backend.onrender.com/companies-for-positions?ids=${ids}`;
        if (f.training_modes && f.training_modes.length > 0) {
          url += `&training_modes=${f.training_modes.join(",")}`;
        }
        if (f.company_sizes && f.company_sizes.length > 0) {
          url += `&company_sizes=${f.company_sizes.join(",")}`;
        }
        if (f.industries && f.industries.length > 0) {
          url += `&industries=${f.industries.join(",")}`;
        }
        if (f.cultures && f.cultures.length > 0) {
          url += `&cultures=${f.cultures.join(",")}`;
        }

        console.log("✅ Fetching companies with URL:", url);

        const companyRes = await fetch(url);
        const companyData = await companyRes.json();

        if (companyData.success && Array.isArray(companyData.companies)) {
          result.companies = companyData.companies;
          renderCompanies(result.companies, result.recommended_positions);
        }
      }
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

  function renderCompanies(companies, positions) {
    positions.forEach((pos, index) => {
      const compContainer = document.getElementById(`companies-${index}`);
      const filtered = companies.filter(c => true);
      if (filtered.length > 0) {
        compContainer.innerHTML = "<p><strong>Based on your preferences, you fit in:</strong></p>";
        filtered.forEach((c, i) => {
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

function restartWizard() {
  localStorage.removeItem("fullName");
  localStorage.removeItem("gender");
  localStorage.removeItem("majorId");
  localStorage.removeItem("dateOfBirth");

  localStorage.removeItem("selectedSubjectIds");
  localStorage.removeItem("selectedTechnicalSkills");
  localStorage.removeItem("selectedNonTechnicalSkills");

  localStorage.removeItem("trainingModeId");
  localStorage.removeItem("trainingModeDesc");
  localStorage.removeItem("companySizeId");
  localStorage.removeItem("companySizeDesc");
  localStorage.removeItem("industryIds");
  localStorage.removeItem("selectedIndustryNames");
  localStorage.removeItem("companyCulture");
  localStorage.removeItem("cultureMap");

  localStorage.removeItem("recommendationResult");
  localStorage.removeItem("fallbackTriggered");
  localStorage.removeItem("finalWizardData");

  window.location.href = "/traintrack";
}
