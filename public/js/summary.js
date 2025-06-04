const userId = localStorage.getItem("userId");
if (!userId) {
  console.warn("⚠️ No user ID found in localStorage");
}

document.addEventListener("DOMContentLoaded", function () {
  const container = document.getElementById("positionResultsContainer");
  const fallbackTriggered = localStorage.getItem("fallbackTriggered");
  const finalWizardData = localStorage.getItem("finalWizardData");
  const urlParams = new URLSearchParams(window.location.search);
  let trialId = urlParams.get("trial_id");

if (!trialId) {
  // Try extracting from /summary/:id
  const pathMatch = window.location.pathname.match(/\/summary\/(\d+)/);
  if (pathMatch) trialId = pathMatch[1];
}

// 👇 Check for saved trial ID first
if (trialId) {
  console.log("📦 Loading from trial_id:", trialId);
  fetch(`https://train-track-backend.onrender.com/user/trial/${trialId}`, {
  credentials: "include"
})
.then(res => res.json())
.then(result => {
  if (!result || !result.success || !result.trialData?.result_data?.recommended_positions) {
    throw new Error("Invalid trial result.");
  }

  const trialResult = result.trialData.result_data;
  localStorage.setItem("recommendationResult", JSON.stringify(trialResult));
  renderSummary(trialResult);
})
.catch(err => {
  console.error("❌ Failed to load saved trial:", err);
  Swal.fire("Error", "Could not load saved trial. Please try again.", "error");
});


  return; // ✅ Stop here: don't continue to live wizard logic
}

// ✅ Normal logic: Live wizard mode
if (!finalWizardData && !trialId) {
  showError("Wizard data missing. Please restart the wizard.");
  return;
}


  const homeBtn = document.getElementById("goHomeBtn");
  if (homeBtn) {
    homeBtn.addEventListener("click", () => {
      window.location.href = "/";
    });
  }try {
  const fullData = JSON.parse(finalWizardData);
  if (fullData) {
    const fallbackPayload = {
      subjects: fullData.selectedSubjectIds || [],
      technical_skills: fullData.selectedTechnicalSkills || [],
      non_technical_skills: fullData.selectedNonTechnicalSkills || [],
      advanced_preferences: fullData.advancedPreferences || {},
      previous_fallback_ids: [],
      is_fallback: true
    };
    localStorage.setItem("previousFallbackPayload", JSON.stringify(fallbackPayload));
  }
} catch (err) {
  console.warn("⚠️ Could not prepare fallbackPayload from finalWizardData", err);
}


if (!finalWizardData && !trialId) {
    showError("Wizard data missing. Please restart the wizard.");
    return;
  }

 fetch("https://train-track-backend.onrender.com/recommendations", {
  method: "POST",
  headers: { "Content-Type": "application/json" },
  body: finalWizardData
})
  .then(async result => result.json())
  .then(async result => {
console.log("🔎 FULL raw result object:", result);
  console.log("➡️ match_scenario key value:", result.match_scenario);

    console.log("🎯 Recommendation result:", result); // ✅ LOG IT
    if (!result.success || !Array.isArray(result.recommended_positions)) {
      throw new Error("No valid recommendations returned.");
    }
// ✅ Save trial for logged-in users
const userId = localStorage.getItem("userId");
if (userId) {
  fetch("https://train-track-backend.onrender.com/wizard/save-trial", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      user_id: parseInt(userId),
      status_class: "completed",
      status_label: "Completed",
      saved_data: JSON.parse(localStorage.getItem("finalWizardData")),
      result_data: result,
      is_submitted: true
    })
  })
  .then(res => res.json())
  .then(data => {
    console.log("✅ Trial saved successfully:", data);
    Swal.fire({
  icon: "success",
  title: "Saved to Profile 🎉",
  text: "You can view this result in your profile later.",
  toast: true,
  position: "top-end",
  timer: 3000,
  showConfirmButton: false
});

  })
  .catch(err => {
    console.error("❌ Failed to save trial:", err);
  });
}

      // ✅ Check for "No Match" case: all results exist but are too weak
const allNoMatch = result.recommended_positions.length > 0 &&
                   result.recommended_positions.every(pos =>
                     pos.fit_level?.toLowerCase() === "no match"
                   );

if (allNoMatch) {  // ✅ This must match the variable name above
  Swal.fire({
    title: '❌ No Match',
    html: `<p style="color: #333; font-size: 15px;">
             Dear, you may not have focused on your choices and may have chosen random options,<br>
             so there are no matching positions.<br><br>
             Please restart the wizard and try again.
           </p>`,
    confirmButtonText: '🚀 Restart the Wizard',
    allowOutsideClick: false,
    allowEscapeKey: false,
    showCancelButton: false,
    customClass: {
      popup: 'fallback-card',
      confirmButton: 'fallback-btn-confirm'
    }
  }).then(() => {
    restartWizard();
  });

  return; // ❗ Stop execution here
}


  // ✅ Save result normally
  localStorage.setItem("recommendationResult", JSON.stringify(result));

  // ✅ Case 2: Fallback match triggered
  if (
    result.recommended_positions?.length > 0 &&
    result.recommended_positions[0].fit_level?.toLowerCase() === "fallback"
  ) {
    result.match_scenario = "fallback";

    Swal.fire({
      title: '⚡ No Perfect Match Found',
      html: `<p style="margin: 0; color: #444; font-size: 15px;">
          Based on your selections, no strong position match was found.<br>
          You can improve your results by selecting more subjects or skills.
        </p>`,
      showCancelButton: true,
      reverseButtons: true,
      cancelButtonText: 'Skip, Maybe Later',
      confirmButtonText: '🚀 Yes, Improve My Selection',
      customClass: {
        popup: 'fallback-card',
        confirmButton: 'fallback-btn-confirm',
        cancelButton: 'fallback-btn-cancel'
      },
      background: '#fff',
      allowOutsideClick: false,
      allowEscapeKey: false
    }).then(popupResult => {
  if (popupResult.isConfirmed) {
    try {
      const fullData = JSON.parse(localStorage.getItem("finalWizardData") || "{}");
      const previousIds = result.recommended_positions.map(p => p.position_id);

      const fallbackPayload = {
        subjects: fullData.subjects || fullData.selectedSubjectIds || [],
        technical_skills: fullData.technical_skills || fullData.selectedTechnicalSkills || [],
        non_technical_skills: fullData.non_technical_skills || fullData.selectedNonTechnicalSkills || [],
        advanced_preferences: fullData.advanced_preferences || fullData.advancedPreferences || {},
        previous_fallback_ids: previousIds,
        is_fallback: true
      };

      console.log("💾 Saving previousFallbackPayload:", fallbackPayload);
      localStorage.setItem("previousFallbackPayload", JSON.stringify(fallbackPayload));
      window.location.href = "/traintrack/fallback/improve";
    } catch (err) {
      console.warn("⚠️ Could not save fallback payload", err);
      Swal.fire("Error", "Failed to prepare fallback page. Please restart the wizard.", "error");
    }
  }



 else {
        localStorage.setItem("fallbackTriggered", "true");
        renderSummary(result); // ✅ Show weak fallback cards only if user skips

        // ✅ Append "Improve" button manually
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
        const container = document.getElementById("positionResultsContainer");
        container.appendChild(improveDiv);

       document.getElementById("improveBtn").addEventListener("click", () => {
      const fullData = JSON.parse(localStorage.getItem("finalWizardData") || "{}");
      const fallbackIds = result.recommended_positions
      .filter(p => p.fit_level?.toLowerCase() === "fallback")
      .map(p => p.position_id);
      
      const payload = {
        subjects: fullData.subjects || fullData.selectedSubjectIds || [],
        technical_skills: fullData.technical_skills || fullData.selectedTechnicalSkills || [],
        non_technical_skills: fullData.non_technical_skills || fullData.selectedNonTechnicalSkills || [],
        advanced_preferences: fullData.advanced_preferences || fullData.advancedPreferences || {},
        previous_fallback_ids: fallbackIds,
        is_fallback: true
};

  localStorage.setItem("previousFallbackPayload", JSON.stringify(payload));
  localStorage.removeItem("fallbackTriggered");
  window.location.href = "/traintrack/fallback/improve";
});

    }
  });

  return;
}

      // ✅ Fetch company matches if needed
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
           <div class="position-line">
  <h3 class="position-name">${pos.position_name}</h3>
  <p class="match-label">📌 ${pos.fit_level}</p>
</div>
          </div>
        </div>

        <div class="card-details" style="display: none">
         <div class="match-breakdown">
         <div class="bar-label">Subject Match <span>${pos.subject_fit_percentage.toFixed(1)}%</span></div>
         <div class="bar-container"><div class="bar" id="subject-${index}"></div></div>

         <div class="bar-label">Technical Skill <span>${pos.technical_skill_fit_percentage.toFixed(1)}%</span></div>
         <div class="bar-container"><div class="bar" id="tech-${index}"></div></div>

         <div class="bar-label">Non-Technical Skill <span>${pos.non_technical_skill_fit_percentage.toFixed(1)}%</span></div>
         <div class="bar-container"><div class="bar" id="nontech-${index}"></div></div>
       </div>

          <a href="/traintrack/position/${pos.position_id}" class="read-more-btn">💼 Read More About the Position</a>
          <div class="company-section" id="companies-${index}"></div>
          <button class="toggle-more-btn">Show Less ▲</button>
        </div>

        <button class="toggle-more-btn show-more-btn" data-index="${index}">Show More ▼</button>
      `;

      container.appendChild(card);
      renderCircularProgress(`progress-${index}`, pos.match_score_percentage);
      renderLinearProgress(`subject-${index}`, pos.subject_fit_percentage);
      renderLinearProgress(`tech-${index}`, pos.technical_skill_fit_percentage);
      renderLinearProgress(`nontech-${index}`, pos.non_technical_skill_fit_percentage);
    });

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

    // ✅ Add companies if available
    if (result.companies) {
      renderCompanies(result.companies, result.recommended_positions);
    }
  }

  function renderCircularProgress(id, percent) {
    const el = document.getElementById(id);
    if (!el) return;
    el.style.background = `conic-gradient(#f59f0d  ${percent}%, #e0e0e0 ${percent}%)`;
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
<div class="company-entry">
  <div class="company-info">
    ${i + 1}. ${c.company_name}<br>
    📍 ${c.location} | 🏛 ${c.industry} | 🏢 ${c.company_size}
  </div>
  <a href="/company-details/${c.company_id}" target="_blank" class="company-read-btn">About the company</a>

</div>
`;
        });
      }
    });
  }
});

// 🔁 Restart wizard flow
function restartWizard() {
  const keys = [
    "fullName", "gender", "majorId", "dateOfBirth",
    "selectedSubjectIds", "selectedSubjectCategoryIds",
    "selectedTechnicalSkills", "selectedNonTechnicalSkills",
    "trainingModeId", "trainingModeDesc", "companySizeId", "companySizeDesc",
    "industryIds", "selectedIndustryNames", "companyCulture", "cultureMap",
    "recommendationResult", "fallbackTriggered", "finalWizardData"
  ];
  keys.forEach(k => localStorage.removeItem(k));
  window.location.href = "/traintrack";
}