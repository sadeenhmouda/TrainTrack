function applyWizardTheme() {
  const gender = (localStorage.getItem("wizardGender") || "").toLowerCase();
  const root = document.documentElement;

  if (gender === "male") {
    root.style.setProperty("--primary-color", "#f9c367ba"); 
    root.style.setProperty("--accent-color", "#f59e0b");
  } else if (gender === "female") {
    root.style.setProperty("--primary-color", "#EBD9FF");
    root.style.setProperty("--accent-color", "#6A1B9A");
  }
}
document.addEventListener("DOMContentLoaded", applyWizardTheme);
