// ✅ Show native browser alert on page reload or leave
window.addEventListener("beforeunload", function (e) {
  // Optional: only trigger if form is partially filled
  const fullName = document.getElementById("fullName")?.value.trim();
  const gender = document.querySelector(".option-button.selected");
  const major = document.querySelector(".major-pill.selected");
  const day = document.getElementById("dob-day")?.value;
  const month = document.getElementById("dob-month")?.value;
  const year = document.getElementById("dob-year")?.value;

  const isPartiallyFilled = fullName || gender || major || (day && month && year);

  if (isPartiallyFilled) {
    e.preventDefault();
    e.returnValue = ""; // Required to show browser default alert
  }
});
