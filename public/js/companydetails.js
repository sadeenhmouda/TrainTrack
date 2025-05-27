document.addEventListener("DOMContentLoaded", () => {
  const el = document.querySelector(".fade-in");
  const loading = document.getElementById("loadingBox");
  const content = document.getElementById("mainContent");

  // Animate fade-in
  if (el) {
    setTimeout(() => {
      el.classList.add("show");
    }, 100);
  }

  // Hide loader, show content
  if (loading && content) {
    setTimeout(() => {
      loading.style.display = "none";
      content.style.display = "block";
    }, 400); // Add small delay if desired
  }
});