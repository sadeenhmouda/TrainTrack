function toggleDropdown() {
  const dropdown = document.querySelector(".dropdown");
  dropdown.classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.closest('.dropdown')) {
    const dropdown = document.querySelector(".dropdown");
    dropdown.classList.remove("show");
  }
};
