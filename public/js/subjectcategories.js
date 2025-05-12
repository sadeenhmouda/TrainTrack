document.addEventListener("DOMContentLoaded", function () {
  const API_URL = "https://train-track-backend.onrender.com/wizard/subject-categories";
  const categoryGrid = document.getElementById("categoryGrid");
  const nextBtn = document.getElementById("nextBtn");
  const selectedCount = document.getElementById("selectedCount");
  const nextRoute = window.nextRoute || "/traintrack/subjecttopics";

  let selectedCategories = [];

  // ✅ Fetch subject categories from backend
  fetch(API_URL)
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        renderCategories(result.data);
      } else {
        categoryGrid.innerHTML = "<p class='text-red-500'>⚠️ Could not load categories.</p>";
      }
    })
    .catch(error => {
      console.error("Error fetching categories:", error);
      categoryGrid.innerHTML = "<p class='text-red-500'>⚠️ API Error. Try again later.</p>";
    });

  // ✅ Render the subject category cards
  function renderCategories(categories) {
    categoryGrid.innerHTML = "";

    categories.forEach(cat => {
      const card = document.createElement("div");
      card.classList.add("subject-card");
      card.setAttribute("data-id", cat.id);

      card.innerHTML = `
        <img src="${cat.image_url || 'https://via.placeholder.com/100'}" alt="${cat.name}">
        <span>${cat.name}</span>
      `;

      // ✅ Click event to select/unselect
      card.addEventListener("click", () => toggleCategory(card, cat.id));
      categoryGrid.appendChild(card);
    });

    // ✅ Restore from localStorage if already selected
    const saved = JSON.parse(localStorage.getItem("selectedSubjectCategoryIds") || "[]");
    saved.forEach(id => {
      const card = categoryGrid.querySelector(`.subject-card[data-id="${id}"]`);
      if (card) {
        card.classList.add("selected");
        selectedCategories.push(id);
      }
    });

    updateUI();
  }

  // ✅ Toggle category selection
  function toggleCategory(card, id) {
    const alreadySelected = selectedCategories.includes(id);

    if (alreadySelected) {
      selectedCategories = selectedCategories.filter(cid => cid !== id);
      card.classList.remove("selected");
    } else {
      if (selectedCategories.length >= 3) {
        alert("You can only select 3 categories.");
        return;
      }
      selectedCategories.push(id);
      card.classList.add("selected");
    }

    updateUI();
  }

  // ✅ Update UI elements
  function updateUI() {
    if (selectedCount) {
      selectedCount.textContent = selectedCategories.length;
    }

    nextBtn.disabled = selectedCategories.length !== 3;
    nextBtn.classList.toggle("active", selectedCategories.length === 3);
  }

  // ✅ Save selected categories and continue
  nextBtn.addEventListener("click", () => {
    if (selectedCategories.length === 3) {
      localStorage.setItem("selectedSubjectCategoryIds", JSON.stringify(selectedCategories));
      window.location.href = nextRoute;
    } else {
      alert("Please select exactly 3 categories.");
    }
  });
});
