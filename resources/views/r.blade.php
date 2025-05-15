<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Train Track – Summary & Results</title>

  <!-- Fonts & Styles -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/summary.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>

<body class="wizard-body">
  <div class="wizard-layout">

    {{-- ✅ Sidebar --}}
    @include('traintrack.partials.sidebar', ['currentStep' => 6])

    {{-- ✅ Right Side --}}
    <div class="summary-area">
      <h1 class="summary-title">🎯 Summary & Results</h1>
      <p class="summary-sub">✨ The right track starts here. ✨</p>

      <!-- ✅ Export Date (Initially Hidden) -->
      <p id="exportDate" style="display: none; font-size: 14px; margin-top: 10px;">📅 Exported On: </p>

      <!-- ✅ Required for JS to work -->
      <div id="positionResultsContainer"></div>

      <!-- Footer Buttons -->
      <div class="summary-actions">
        <button onclick="goToSelections()">🔗 My Selections</button>
        <button onclick="restartWizard()">🔁 Restart Wizard</button>
        <button onclick="goHome()">🏠 Home</button>
        <button id="downloadPdfBtn" class="export-btn">📝 Export PDF</button>
      </div>
    </div>
  </div>

  <!-- ✅ Attach JavaScript Logic -->
  <script src="{{ asset('js/summary.js') }}"></script>
  <script>
    document.getElementById("downloadPdfBtn").addEventListener("click", () => {
      const element = document.querySelector(".summary-area");
      const exportDate = document.getElementById("exportDate");

      // ✅ Format today's date and show it
      const today = new Date().toISOString().split("T")[0];
      exportDate.textContent = `📅 Exported On: ${today}`;
      exportDate.style.display = "block";

      const opt = {
        margin: 0.5,
        filename: `TrainTrack_Report_${today}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
      };

      // ✅ Generate and download PDF, then hide export date again
      html2pdf().set(opt).from(element).save().then(() => {
        exportDate.style.display = "none";
      });
    });
  </script>
</body>
</html> 
/* ===== Layout ===== */
.summary-area {
  flex: 1;
  padding: 2rem 3rem;
  background-color: #fff;
}

.summary-title {
  font-size: 28px;
  font-weight: bold;
  color: #333;
  margin-bottom: 0.2rem;
}

.summary-sub {
  font-size: 16px;
  color: #777;
  margin-bottom: 1.5rem;
}

/* ===== Card ===== */
.position-card {
  border: 1px solid #ddd;
  border-radius: 12px;
  padding: 1.2rem 1.5rem;
  margin-bottom: 1.5rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  background: #f9f9f9;
}

.track-text {
  font-size: 14px;
  color: #666;
  margin-bottom: 0.2rem;
}

.position-name {
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.match-badge {
  display: inline-block;
  padding: 6px 10px;
  background-color: #f0f0f0;
  border-radius: 20px;
  font-size: 14px;
  color: #6A1B9A;
  font-weight: 500;
  margin-bottom: 0.8rem;
}

.card-top button,
.card-details button {
  padding: 6px 14px;
  border: none;
  background-color: #ccc;
  color: #333;
  border-radius: 6px;
  font-size: 14px;
  cursor: pointer;
  transition: background 0.2s;
}

.card-top button:hover,
.card-details button:hover {
  background-color: #bbb;
}

/* ===== Details Section ===== */
.card-details {
  padding-top: 1rem;
  border-top: 1px solid #ddd;
}

.match-breakdown p {
  margin: 0.3rem 0;
  font-size: 15px;
  color: #333;
}

.company-section p {
  font-size: 14px;
  margin: 0.3rem 0 0.6rem;
  color: #444;
}

/* ===== Buttons ===== */
.summary-actions {
  margin-top: 2rem;
  display: flex;
  gap: 1rem;
}

.summary-actions button {
  background-color: #eee;
  border: none;
  padding: 10px 16px;
  border-radius: 8px;
  font-size: 14px;
  cursor: pointer;
  transition: background 0.2s;
}

.summary-actions button:hover {
  background-color: #ddd;
}
/* ===== Export PDF Button ===== */
.export-btn {
  display: inline-block;
  padding: 10px 16px;
  background-color: #5C3DFF;
  color: white;
  border-radius: 8px;
  text-align: center;
  text-decoration: none;
  font-weight: 500;
  font-size: 14px;
  transition: background-color 0.2s ease;
  cursor: pointer;
}

.export-btn:hover {
  background-color: #402dbf;
}


/* ===== No Match SweetAlert2 Popup Styling ===== */
.swal2-popup.no-match-popup {
  width: 900px !important;
  padding: 3rem !important;
  font-family: 'Roboto', sans-serif;
  text-align: center;
  border-radius: 12px;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

/* Title */
.swal2-popup.no-match-popup .swal2-title {
  font-size: 26px;
  font-weight: 650;
  color: #333;
  margin-bottom: 2rem;
}

/* Body Text – line spacing and spacing between paragraphs */
.swal2-popup.no-match-popup .swal2-html-container p {
  font-size: 16px;
  color: #444;
  line-height: 1.8;
  margin-bottom: 1rem;
}

/* Final strong line inside popup */
.swal2-popup.no-match-popup .swal2-html-container strong {
  display: block;
  margin-top: 1.5rem;
  font-size: 16px;
  color: #000;
}

/* Confirm Button */
.swal2-popup.no-match-popup .swal2-confirm {
  background-color: #6A1B9A !important;
  color: white !important;
  font-size: 16px;
  padding: 10px 24px;
  border-radius: 8px;
  font-weight: 500;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
  transition: background-color 0.2s ease;
}

.swal2-popup.no-match-popup .swal2-confirm:hover {
  background-color: #591681 !important;
}

/* Responsive for small screens */
@media (max-width: 600px) {
  .swal2-popup.no-match-popup {
    width: 90% !important;
    padding: 2rem !important;
  }

  .swal2-popup.no-match-popup .swal2-title {
    font-size: 24px;
  }

  .swal2-popup.no-match-popup .swal2-html-container p {
    font-size: 15px;
    line-height: 1.9;
  }

  .swal2-popup.no-match-popup .swal2-confirm {
    font-size: 15px;
    padding: 8px 20px;
  }
}






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
              📍 ${c.location} | 🏭 ${c.industry} | 🏢 ${c.company_size}
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

