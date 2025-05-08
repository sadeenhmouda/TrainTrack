document.addEventListener("DOMContentLoaded", function () {
  const topicsContainer = document.getElementById("topicsContainer");
  const nextBtn = document.getElementById("nextBtn");
  const selectedCount = document.getElementById("selectedCount");
  const warningEl = document.getElementById("selectionWarning");

  let selectedTopics = [];

  // ✅ Start from 0
  localStorage.removeItem("selectedSubjectIds");
  updateCounter();

  // ✅ Fetch topics based on categories
  function fetchTopics() {
    const categoryIds = localStorage.getItem("selectedCategoryIds");
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

  // ✅ Render topics
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

        btn.addEventListener("click", () => toggleTopic(btn, sub.id, cat.Subject_category_id));
        btnContainer.appendChild(btn);
      });

      group.appendChild(btnContainer);
      topicsContainer.appendChild(group);
    });
  }

  // ✅ Toggle topic
  function toggleTopic(button, id, categoryId) {
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

  // ✅ Counter & Validation
  function updateCounter() {
    selectedCount.textContent = selectedTopics.length;

    const usedCategoryIds = new Set();

    document.querySelectorAll(".topic-btn.selected").forEach(btn => {
      const categoryId = btn.getAttribute("data-category-id");
      if (categoryId) usedCategoryIds.add(categoryId);
    });

    const isValid = selectedTopics.length === 7 && usedCategoryIds.size === 3;
    nextBtn.disabled = !isValid;

    // Show/hide warning
    if (selectedTopics.length === 7 && usedCategoryIds.size < 3) {
      warningEl.style.display = "block";
    } else {
      warningEl.style.display = "none";
    }
  }

  // ✅ Save & Go
  nextBtn.addEventListener("click", () => {
    localStorage.setItem("selectedSubjectIds", selectedTopics.join(","));
    window.location.href = "/traintrack/technical";
  });

  // ✅ Start fetching
  fetchTopics();
});
