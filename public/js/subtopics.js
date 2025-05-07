document.addEventListener("DOMContentLoaded", function () {
    const topicsContainer = document.getElementById("topicsContainer");
    const nextBtn = document.getElementById("nextBtn");
    const selectedCount = document.getElementById("selectedCount");
  
    let selectedTopics = [];
  
    // ✅ 1. Restore if previously saved
    const saved = localStorage.getItem("selectedSubjectIds");
    if  (saved) {
        const temp = saved.split(",").map(Number);
        if (temp.length === 7) {
          selectedTopics = temp;
          updateCounter();
        } else {
          localStorage.removeItem("selectedSubjectIds"); // Clear incomplete old data
        }
    }
  
    // ✅ 2. Fetch topics from backend based on selectedCategoryIds
    function fetchTopics() {
      const categoryIds = localStorage.getItem("selectedCategoryIds");
      if (!categoryIds) return;
  
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
  
    // ✅ 3. Render topics per category
    function renderTopics(categories) {
      topicsContainer.innerHTML = "";
  
      categories.forEach(cat => {
        const group = document.createElement("div");
        group.classList.add("category-group");
  
        const title = document.createElement("h2");
        title.textContent = cat.Subject_category_name;
        group.appendChild(title);
  
        const btnContainer = document.createElement("div");
        btnContainer.classList.add("topic-buttons");
  
        cat.subjects.forEach(sub => {
          const btn = document.createElement("button");
          btn.textContent = sub.name;
          btn.classList.add("topic-btn");
  
          if (selectedTopics.includes(sub.id)) {
            btn.classList.add("selected");
          }
  
          btn.addEventListener("click", () => toggleTopic(btn, sub.id));
          btnContainer.appendChild(btn);
        });
  
        group.appendChild(btnContainer);
        topicsContainer.appendChild(group);
      });
    }
  
    // ✅ 4. Toggle logic
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
  
    // ✅ 5. Update counter + enable Next
    function updateCounter() {
      selectedCount.textContent = selectedTopics.length;
      nextBtn.disabled = selectedTopics.length !== 7;
    }
  
    // ✅ 6. Save to localStorage + go to next
    nextBtn.addEventListener("click", () => {
      localStorage.setItem("selectedSubjectIds", selectedTopics.join(","));
      window.location.href = "/traintrack/technical";
    });
  
    // ✅ 7. Start
    fetchTopics();
  });
  