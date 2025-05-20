document.addEventListener("DOMContentLoaded", () => {
  // ✅ Define positionId from URL
  const pathSegments = window.location.pathname.split('/');
  const positionId = pathSegments[pathSegments.length - 1];

  if (!positionId || positionId === "undefined") {
    document.body.innerHTML = "<p style='color:red;text-align:center;'>❌ Invalid position ID.</p>";
    return;
  }

  fetch(`https://train-track-backend.onrender.com/position/${positionId}`)
    .then(res => res.json())
    .then(data => {
      if (!data.success) throw new Error("Position not found.");

      document.getElementById("positionName").textContent = data.position_name;
      document.getElementById("description").textContent = data.description;

      const iconMap = {
        YouTube: "📺",
        Course: "📖",
        Roadmap: "🗺️",
        GitHub: "💻",
        Website: "🌐",
        Article: "📰",
        Podcast: "🎙️"
      };

      const resourceList = document.getElementById("resources");
      data.resources.forEach(r => {
        const icon = iconMap[r.resource_type] || "📘";
        const li = document.createElement("li");
        li.innerHTML = `${icon} <a href="${r.url}" target="_blank" rel="noopener noreferrer">${r.title}</a>`;
        resourceList.appendChild(li);
      });

      const tasksList = document.getElementById("tasks");
      data.tasks.forEach(task => {
        const li = document.createElement("li");
        li.textContent = task;
        tasksList.appendChild(li);
      });

      document.getElementById("tips").textContent = data.tips;
    })
    .catch(err => {
      console.error("❌ Error:", err);
      document.body.innerHTML = "<p style='color:red;text-align:center;'>❌ Failed to load position details.</p>";
    });
});
