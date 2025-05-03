// ✅ 1. Check if page needs scrollbar
window.addEventListener("load", () => {
  const bodyHeight = document.body.scrollHeight;
  const screenHeight = window.innerHeight;

  if (bodyHeight > screenHeight) {
    console.log("⚠️ Page overflows. Scrollbar needed.");
  } else {
    console.log("✅ Page fits perfectly. No scrollbar needed.");
  }
});

// ✅ 2. DOM Ready Logic
document.addEventListener("DOMContentLoaded", function () {
  const nameField = document.getElementById("fullName");

  // ✅ Restore from localStorage if available
  const savedData = JSON.parse(localStorage.getItem("personal_info"));
  if (savedData) {
    nameField.value = savedData.fullName || '';

    // Restore gender
    document.querySelectorAll(".option-button").forEach(btn => {
      if (btn.textContent.trim() === savedData.gender) {
        btn.classList.add("selected");
      }
    });

    // Restore major
    document.querySelectorAll(".major-pill").forEach(pill => {
      if (pill.textContent.trim() === savedData.major) {
        pill.classList.add("selected");
      }
    });

    // Restore DOB (if saved)
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

  // ✅ Major selection logic
  document.querySelectorAll(".major-pill").forEach(pill => {
    pill.addEventListener("click", () => {
      document.querySelectorAll(".major-pill").forEach(p => p.classList.remove("selected"));
      pill.classList.add("selected");

      const error = document.querySelector(".major-options .error");
      if (error) error.remove();
    });
  });

  // ✅ Clear name error while typing
  nameField.addEventListener("input", function () {
    const error = this.nextElementSibling;
    if (error && error.classList.contains("error") && this.value.trim()) {
      error.remove();
    }
  });
  // ✅ Clear DOB error dynamically when all 3 dropdowns are selected
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


  // ✅ Handle form submission
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
        major: selectedMajor.textContent.trim()
      };
      localStorage.setItem("personal_info", JSON.stringify(formData));
      window.location.href = "/traintrack/subject";
    }
  });
});

// ✅ Error display helpers
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
