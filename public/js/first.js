const userId = localStorage.getItem("userId");
if (!userId) {
  console.warn("⚠️ No user ID found in localStorage");
}
function applyWizardTheme() {
  const gender = localStorage.getItem("wizardGender");
  const root = document.documentElement;

  if (gender === "male") {
    root.style.setProperty("--primary-color", "#facf87e3");
    root.style.setProperty("--accent-color", "#f9c367");
  } else if (gender === "female") {
    root.style.setProperty("--primary-color", "#6A1B9A");
    root.style.setProperty("--accent-color", "#EBD9FF");
  }
}

document.addEventListener("DOMContentLoaded", applyWizardTheme);


// ✅ Global months array — MUST BE HERE to prevent crash on "Next"
const months = [
  "January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

// ✅ Check if scrollbar is needed
window.addEventListener("load", () => {
  const bodyHeight = document.body.scrollHeight;
  const screenHeight = window.innerHeight;
  console.log(bodyHeight > screenHeight ? "⚠️ Page overflows. Scrollbar needed." : "✅ Page fits perfectly. No scrollbar needed.");
});

document.addEventListener("DOMContentLoaded", function () {
  const keysToClear = [
    "selectedSubjectIds", "selectedTechnicalSkills", "selectedNonTechnicalSkills",
    "trainingModeId", "companySizeId", "industryIds",
    "recommendationResult", "fallbackTriggered"
  ];
  keysToClear.forEach(key => localStorage.removeItem(key));

  const nameInput = document.getElementById("fullName");
  nameInput.addEventListener("keypress", function (e) {
    const char = String.fromCharCode(e.which);
    if (!/^[A-Za-z\s]$/.test(char)) e.preventDefault();
  });
  nameInput.addEventListener("input", () => {
    const err = document.querySelector("#fullName + .error");
    if (nameInput.value.trim() && err) err.remove();
  });

  setupDropdown("monthDropdown", months);
  const days = Array.from({ length: 31 }, (_, i) => String(i + 1).padStart(2, "0"));
  setupDropdown("dayDropdown", days);
  const maxYear = new Date().getFullYear() - 17;
  const years = [];
  for (let y = maxYear; y >= 1990; y--) years.push(String(y));
  setupDropdown("yearDropdown", years);

  document.querySelectorAll(".option-button").forEach(btn => {
    btn.addEventListener("click", () => {
      document.querySelectorAll(".option-button").forEach(b => b.classList.remove("selected"));
      btn.classList.add("selected");
      const error = document.querySelector(".button-group + .error");
      if (error) error.remove();
    });
  });

  fetch("https://train-track-backend.onrender.com/wizard/majors")
    .then(res => res.json())
    .then(result => {
      if (result.success && result.data) {
        const majorOptionsDiv = document.getElementById("majorOptions");
        majorOptionsDiv.innerHTML = "";
        const emojiMap = {
          "Computer Science Apprenticeship Program": "🧑‍💻",
          "Management Information Systems": "💼",
          "Computer Science": "💻",
          "Cyber Security": "🔐",
          "Computer Engineering": "🛠️",
          "Network Information System": "🌐"
        };
        result.data.forEach(major => {
          const pill = document.createElement("span");
          pill.classList.add("major-pill");
          pill.dataset.id = major.id;
          pill.textContent = `${emojiMap[major.name] || "🎓"} ${major.name}`;
          majorOptionsDiv.appendChild(pill);
        });
        document.querySelectorAll(".major-pill").forEach(pill => {
          pill.addEventListener("click", () => {
            document.querySelectorAll(".major-pill").forEach(p => p.classList.remove("selected"));
            pill.classList.add("selected");
            const error = document.querySelector(".major-options .error");
            if (error) error.remove();
          });
        });
      }
    })
    .catch(err => console.error("❌ Failed to load majors:", err));

  document.querySelector(".next")?.addEventListener("click", function (e) {
    e.preventDefault();
    const fullName = nameInput.value.trim();
    const genderBtn = document.querySelector(".option-button.selected");
    const majorPill = document.querySelector(".major-pill.selected");
    const dayEl = document.querySelector("#dayDropdown .selected");
    const monthEl = document.querySelector("#monthDropdown .selected");
    const yearEl = document.querySelector("#yearDropdown .selected");

    const day = dayEl.textContent;
    const month = monthEl.textContent;
    const year = yearEl.textContent;

    document.querySelectorAll(".error").forEach(el => el.remove());
    let isValid = true;

    if (!fullName) {
      showErrorUnder("#fullName", "Full name is required");
      isValid = false;
    }
    if (!genderBtn) {
      showErrorUnder(".button-group", "Please select your gender");
      isValid = false;
    }
    if (![dayEl, monthEl, yearEl].every(el => el.classList.contains("active"))) {
      showErrorUnder(".dob-selects", "Please complete your date of birth");
      isValid = false;
    } else if (parseInt(year) > 2008) {
      showErrorUnder(".dob-selects", "You must be born in 2008 or earlier.");
      isValid = false;
    }
    if (!majorPill) {
      const lastPill = document.querySelector(".major-pill:last-child");
      const error = document.createElement("div");
      error.className = "error";
      error.style.color = "red";
      error.style.marginTop = "6px";
      error.textContent = "Please select your major";
      lastPill.insertAdjacentElement("afterend", error);
      isValid = false;
    }

    if (isValid) {
      const gender = genderBtn.textContent.trim().replace(/^[^\w]+/, "");
      const majorId = majorPill.dataset.id;
      const dob = `${year}-${String(months.indexOf(month) + 1).padStart(2, "0")}-${day}`;

      const formData = {
        full_name: fullName,
        gender,
        date_of_birth: dob,
        major_id: majorId
      };

      localStorage.setItem("personal_info", JSON.stringify(formData));
      localStorage.setItem("wizardGender", gender.toLowerCase()); // ✅ required by theme.js
      localStorage.setItem("fullName", fullName);
      localStorage.setItem("gender", gender);
      localStorage.setItem("majorId", majorId);
      localStorage.setItem("dateOfBirth", dob);
      console.log("✅ Saved personal info:", formData);
      window.location.href = "/traintrack/subject";
    }
  });
});

function setupDropdown(id, options) {
  const container = document.getElementById(id);
  const display = container.querySelector(".selected");
  const list = container.querySelector(".options");

  options.forEach(opt => {
    const li = document.createElement("li");
    li.textContent = opt;
    li.addEventListener("click", () => {
      display.textContent = opt;
      container.classList.remove("open");
      display.classList.add("active");

      const allFilled = ["monthDropdown", "dayDropdown", "yearDropdown"].every(id => {
        return document.querySelector(`#${id} .selected`).classList.contains("active");
      });
      if (allFilled) {
        const error = document.querySelector(".dob-selects + .error");
        if (error) error.remove();
      }
    });
    list.appendChild(li);
  });

  container.addEventListener("click", () => {
    document.querySelectorAll(".custom-dropdown").forEach(d => d.classList.remove("open"));
    container.classList.toggle("open");
  });

  document.addEventListener("click", e => {
    if (!container.contains(e.target)) {
      container.classList.remove("open");
    }
  });
}

function showErrorUnder(selector, message) {
  const el = document.querySelector(selector);
  const error = document.createElement("div");
  error.className = "error";
  error.style.color = "red";
  error.style.marginTop = "6px";
  error.textContent = message;
  el.insertAdjacentElement("afterend", error);
}
