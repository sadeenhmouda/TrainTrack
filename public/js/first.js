// ✅ 1. Check if page needs scrollbar
window.addEventListener("load", () => {
  const bodyHeight = document.body.scrollHeight;
  const screenHeight = window.innerHeight;
  console.log(bodyHeight > screenHeight ? "⚠️ Page overflows. Scrollbar needed." : "✅ Page fits perfectly. No scrollbar needed.");
});

document.addEventListener("DOMContentLoaded", function () {
  const nameField = document.getElementById("fullName");

  // ✅ Populate Month dropdown
  const monthSelect = document.getElementById("dob-month");
  monthSelect.innerHTML = "";
  monthSelect.appendChild(new Option("Month", "", true, true)).disabled = true;
  const months = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];
  months.forEach((month, index) => {
    const value = (index + 1).toString().padStart(2, "0");
    monthSelect.appendChild(new Option(month, value));
  });

  // ✅ Populate Day dropdown
  const daySelect = document.getElementById("dob-day");
  daySelect.innerHTML = "";
  daySelect.appendChild(new Option("Day", "", true, true)).disabled = true;
  for (let d = 1; d <= 31; d++) {
    const padded = d.toString().padStart(2, "0");
    const option = document.createElement("option");
    option.textContent = padded;
    option.value = padded;
    daySelect.appendChild(option);
  }

  // ✅ Populate Year dropdown (current year to 1990)
  const yearSelect = document.getElementById("dob-year");
  yearSelect.innerHTML = "";
  yearSelect.appendChild(new Option("Year", "", true, true)).disabled = true;
  const currentYear = new Date().getFullYear();
  for (let y = currentYear; y >= 1990; y--) {
    const option = document.createElement("option");
    option.textContent = y;
    option.value = y;
    yearSelect.appendChild(option);
  }

  // ✅ Restore saved data
  const savedData = JSON.parse(localStorage.getItem("personal_info"));
  if (savedData) {
    nameField.value = savedData.fullName || '';

    // Restore gender
    document.querySelectorAll(".option-button").forEach(btn => {
      if (btn.textContent.trim() === savedData.gender) {
        btn.classList.add("selected");
      }
    });

    // Restore DOB
    if (savedData.dob) {
      const [day, month, year] = savedData.dob.split("/");
      document.getElementById("dob-day").value = day;
      document.getElementById("dob-month").value = month;
      document.getElementById("dob-year").value = year;
    }
  }

  // ✅ Gender selection logic
  document.querySelectorAll(".option-button").forEach(btn => {
    btn.addEventListener("click", () => {
      document.querySelectorAll(".option-button").forEach(b => b.classList.remove("selected"));
      btn.classList.add("selected");
      const error = document.querySelector(".button-group + .error");
      if (error) error.remove();
    });
  });

  // ✅ Fetch majors with emoji
  fetch("https://train-track-backend.onrender.com/wizard/majors")
    .then(res => res.json())
    .then(result => {
      if (result.success && result.data) {
        const majorOptionsDiv = document.getElementById("majorOptions");
        majorOptionsDiv.innerHTML = '';

        const majorEmojiMap = {
          "Computer Science Apprenticeship Program": "🧑‍💻",
          "Management Information Systems": "💼",
          "Computer Science": "💻",
          "Cyber Security": "🔐",
          "Computer Engineering": "🛠️",
          "Network Information System": "🌐"
        };

        result.data.forEach(major => {
          const span = document.createElement("span");
          span.classList.add("major-pill");
          const emoji = majorEmojiMap[major.name] || "🎓";
          span.textContent = `${emoji} ${major.name}`;
          majorOptionsDiv.appendChild(span);
        });

        // Bind click for majors
        document.querySelectorAll(".major-pill").forEach(pill => {
          pill.addEventListener("click", () => {
            document.querySelectorAll(".major-pill").forEach(p => p.classList.remove("selected"));
            pill.classList.add("selected");
            const error = document.querySelector(".major-options .error");
            if (error) error.remove();
          });
        });

        // Restore selected major
        if (savedData) {
          document.querySelectorAll(".major-pill").forEach(pill => {
            if (pill.textContent.trim() === `${majorEmojiMap[savedData.major] || "🎓"} ${savedData.major}`) {
              pill.classList.add("selected");
            }
          });
        }
      }
    })
    .catch(err => {
      console.error("Error fetching majors:", err);
    });

  // ✅ Live error removal
  nameField.addEventListener("input", function () {
    const error = this.nextElementSibling;
    if (error && error.classList.contains("error") && this.value.trim()) {
      error.remove();
    }
  });

  // ✅ Live DOB error removal
  ["dob-day", "dob-month", "dob-year"].forEach(id => {
    document.getElementById(id).addEventListener("change", () => {
      const day = document.getElementById("dob-day").value;
      const month = document.getElementById("dob-month").value;
      const year = document.getElementById("dob-year").value;
      if (day && month && year) {
        const error = document.querySelector(".dob-selects + .error");
        if (error) error.remove();
      }
    });
  });

  // ✅ Form submission
  const nextButton = document.querySelector(".next");
  nextButton?.addEventListener("click", function (e) {
    e.preventDefault();

    const fullName = nameField.value.trim();
    const selectedGender = document.querySelector(".option-button.selected");
    const selectedMajor = document.querySelector(".major-pill.selected");
    const day = document.getElementById("dob-day")?.value;
    const month = document.getElementById("dob-month")?.value;
    const year = document.getElementById("dob-year")?.value;

    document.querySelectorAll(".error").forEach(el => el.remove());
    let isValid = true;

    if (!fullName) {
      showError("fullName", "Please enter your full name");
      isValid = false;
    }

    if (!day || !month || !year) {
      showErrorUnderElement(".dob-selects", "Please select your full date of birth");
      isValid = false;
    }

    if (!selectedGender) {
      showErrorUnderElement(".button-group", "Please select your gender");
      isValid = false;
    }

    if (!selectedMajor) {
      const lastPill = document.querySelector(".major-pill:last-child");
      showErrorAfterElement(lastPill, "Please select your major");
      isValid = false;
    }

    if (isValid) {
      const dobFormatted = `${day}/${month}/${year}`;
      const formData = {
        fullName,
        dob: dobFormatted,
        gender: selectedGender.textContent.trim(),
        major: selectedMajor.textContent.trim().replace(/^[^\w]+/, '') // remove emoji
      };
      localStorage.setItem("personal_info", JSON.stringify(formData));
      window.location.href = "/traintrack/subject";
    }
  });
});

// ✅ Error helper functions
function showError(inputId, message) {
  const input = document.getElementById(inputId);
  const error = document.createElement("div");
  error.className = "error";
  error.style.color = "red";
  error.style.marginTop = "4px";
  error.textContent = message;
  input.insertAdjacentElement("afterend", error);
}

function showErrorUnderElement(selector, message) {
  const target = document.querySelector(selector);
  const error = document.createElement("div");
  error.className = "error";
  error.style.color = "red";
  error.style.marginTop = "6px";
  error.textContent = message;
  target.insertAdjacentElement("afterend", error);
}

function showErrorAfterElement(element, message) {
  const error = document.createElement("div");
  error.className = "error";
  error.style.color = "red";
  error.style.marginTop = "6px";
  error.textContent = message;
  element.insertAdjacentElement("afterend", error);
}
