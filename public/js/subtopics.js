const userId = localStorage.getItem("userId");
if (!userId) {
  console.warn("⚠️ No user ID found in localStorage");
}
document.addEventListener("DOMContentLoaded", function () { 
  const topicsContainer = document.getElementById("topicsContainer");
  const nextBtn = document.getElementById("nextBtn");
  const selectedCount = document.getElementById("selectedCount");
  const warningEl = document.getElementById("selectionWarning");

  let selectedTopics = [];

  // ✅ Load previously selected topics (if any)
  const saved = localStorage.getItem("selectedSubjectIds");
  if (saved) {
    selectedTopics = JSON.parse(saved);
  }

  updateCounter();

  // ✅ Fetch topics based on selected categories (fix: correct key name!)
  function fetchTopics() {
    const raw = localStorage.getItem("selectedSubjectCategoryIds"); // ✅ Corrected key
    const categoryIds = raw ? JSON.parse(raw).join(",") : "";

    if (!categoryIds) {
      topicsContainer.innerHTML = "<p style='color: red;'>⚠️ No categories selected. Please go back and choose categories first.</p>";
      return;
    }

    fetch(`https://train-track-backend.onrender.com/wizard/subjects?ids=${categoryIds}`)
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          renderTopics(data.data);
        } else {
          topicsContainer.innerHTML = "<p>⚠️ Couldn't load topics.</p>";
        }
      })
      .catch(err => {
        console.error("API error:", err);
        topicsContainer.innerHTML = "<p>⚠️ API error occurred.</p>";
      });
  }

  // ✅ Render all topics and restore selection state
  function renderTopics(categories) {
    topicsContainer.innerHTML = "";

    categories.forEach(cat => {
      const group = document.createElement("div");
      group.classList.add("category-group");
      group.setAttribute("data-category-id", cat.Subject_category_id);

      const title = document.createElement("h2");
      title.textContent = cat.Subject_category_name;
      group.appendChild(title);

      const btnContainer = document.createElement("div");
      btnContainer.classList.add("topic-buttons");

      cat.subjects.forEach(sub => {
        const btn = document.createElement("button");
        btn.textContent = sub.name;
        btn.classList.add("topic-btn");
        btn.setAttribute("data-subject-id", sub.id);
        btn.setAttribute("data-category-id", cat.Subject_category_id);

        // ✅ Restore previous selection
        if (selectedTopics.includes(sub.id)) {
          btn.classList.add("selected");
        }

        btn.addEventListener("click", () => toggleTopic(btn, sub.id));
        btnContainer.appendChild(btn);
      });

      group.appendChild(btnContainer);
      topicsContainer.appendChild(group);
    });
    updateCounter();
  }

  // ✅ Toggle topic selection
  function toggleTopic(button, id) {
    if (selectedTopics.includes(id)) {
      selectedTopics = selectedTopics.filter(t => t !== id);
      button.classList.remove("selected");
    } else {
      if (selectedTopics.length >= 7) return;
      selectedTopics.push(id);
      button.classList.add("selected");
    }

    updateCounter();
  }

  // ✅ Update counter and warning
  function updateCounter() {
    selectedCount.textContent = selectedTopics.length;

    const usedCategoryIds = new Set();
   document.querySelectorAll(".topic-btn.selected").forEach(btn => {
    usedCategoryIds.add(btn.getAttribute("data-category-id"));
   });

   const isValid = selectedTopics.length >= 3 && selectedTopics.length <= 7 && usedCategoryIds.size === 3;

   nextBtn.disabled = !isValid;
  
   // ✅ Add or remove the class properly
   nextBtn.classList.toggle("active", isValid);

   // Show warning only if 7 selected but less than 3 categories used
   warningEl.style.display = (selectedTopics.length === 7 && usedCategoryIds.size < 3)
    ? "block"
    : "none";
  }

  // ✅ Save selections on "Next"
  nextBtn.addEventListener("click", () => {
    localStorage.setItem("selectedSubjectIds", JSON.stringify(selectedTopics));
    window.location.href = "/traintrack/technical";
  });

  // ✅ Start fetching
  fetchTopics();
});
