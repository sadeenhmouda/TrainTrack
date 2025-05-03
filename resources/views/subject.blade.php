<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Train Track Wizard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/subjectcategories.css') }}">
</head>

<body class="wizard-body">
  <div class="wizard-layout">
    {{-- Left Sidebar --}}
    @include('traintrack.partials.sidebar')

    <!-- Right Side: Subject of Interest Step -->
    <div class="subject-form">
      <h1>🧠 Knowledge Background</h1>
      <p>Select max 3 categories to get personalized subject suggestions</p>

      <div class="subject-category-grid" id="categoryGrid"></div>

      <div class="subject-buttons">
        <a href="{{ route('traintrack') }}">
          <button class="btn-back">Back</button>
        </a>
        <button class="btn-next" id="nextBtn" disabled>Next</button>
      </div>
    </div>
  </div> 

  <!-- ✅ Inject Blade route once -->
  <script>
    const nextRoute = "{{ route('traintrack.subject2') }}";
  </script> 
  

  <!-- ✅ JavaScript -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const API_URL = "https://train-track-backend.onrender.com/wizard/subject-categories";
      const categoryGrid = document.getElementById("categoryGrid");
      const nextBtn = document.getElementById("nextBtn");

      let selectedCategories = [];

      fetch(API_URL)
        .then(response => response.json())
        .then(result => {
          if (result.success) {
            renderCategories(result.data);
          } else {
            console.warn("API returned success: false");
          }
        })
        .catch(error => {
          console.error("Error fetching categories:", error);
        });

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

      function toggleCategory(card, id) {
        if (selectedCategories.includes(id)) {
          selectedCategories = selectedCategories.filter(cid => cid !== id);
          card.classList.remove("selected");
        } else {
          if (selectedCategories.length >= 3) {
            alert("You can select up to 3 categories only.");
            return;
          }
          selectedCategories.push(id);
          card.classList.add("selected");
        }

        nextBtn.disabled = selectedCategories.length === 0;
      }

      nextBtn.addEventListener("click", () => {
        localStorage.setItem("selectedCategoryIds", selectedCategories.join(","));
        window.location.href = nextRoute;
      });
    });
  </script>
</body>
</html>
