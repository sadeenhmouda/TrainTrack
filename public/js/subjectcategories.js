// ✅ Blade injects this route above
// const nextRoute = "{{ route('traintrack.subject2') }}";

document.addEventListener("DOMContentLoaded", function () {
    const API_URL = "https://train-track-backend.onrender.com/wizard/subject-categories";
    const categoryGrid = document.getElementById("categoryGrid");
    const nextBtn = document.getElementById("nextBtn");
  
    let selectedCategories = []; // 👈 Start fresh each time
  
    // ✅ Load categories from API
    fetch(API_URL)
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          renderCategories(result.data);
        }
      })
      .catch(error => {
        console.error("Error fetching categories:", error);
      });
  
    // ✅ Render category cards
    function renderCategories(categories) {
      categoryGrid.innerHTML = "";
  
      categories.forEach(cat => {
        const card = document.createElement("div");
        card.classList.add("subject-card");
        card.setAttribute("data-id", cat.id);
  
        card.innerHTML = `
          <img src="${cat.image_url}" alt="${cat.name}">
          <span>${cat.name}</span>
        `;
  
        card.addEventListener("click", () => toggleCategory(card, cat.id));
        categoryGrid.appendChild(card);
      });
    }
  
    // ✅ Handle card selection (limit: exactly 3)
    function toggleCategory(card, id) {
      if (selectedCategories.includes(id)) {
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
  
      // ✅ Enable Next only if 3 selected
      nextBtn.disabled = selectedCategories.length !== 3;
    }
  
    // ✅ On Next: Save and move
    nextBtn.addEventListener("click", () => {
      localStorage.setItem("selectedCategoryIds", selectedCategories.join(","));
      window.location.href = nextRoute;
    });
  });
  