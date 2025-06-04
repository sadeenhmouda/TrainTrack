const userId = localStorage.getItem("userId");
if (!userId) {
  console.warn("⚠️ No user ID found in localStorage");
}
let allTrials = [];

document.addEventListener("DOMContentLoaded", async function () {
  if (!localStorage.getItem("user_id") && userId) {
    localStorage.setItem("user_id", userId);
    localStorage.setItem("is_guest", "false");
  }

  const savedUserId = localStorage.getItem("user_id");
  const isGuest = localStorage.getItem("is_guest");
  const trailContainer = document.getElementById("trailContainer");

  if (!savedUserId || isGuest === "true" || savedUserId !== userId) {
    localStorage.clear();
    trailContainer.innerHTML = `
      <div style="text-align:center; padding:40px;">
        <p>🚀 You haven’t started any training journeys yet!</p>
        <p>Click <strong>“Start New Trial”</strong> to begin exploring opportunities!</p>
        <button id="promptSignInBtn" style="margin-top: 20px; padding: 10px 20px; background-color: #6200ea; color: white; border: none; border-radius: 8px; cursor: pointer;">
          🔐 Sign In to Save Progress
        </button>
      </div>
    `;
    const actions = document.querySelector(".action-buttons");
    if (actions) actions.style.display = "none";

    document.getElementById("promptSignInBtn")?.addEventListener("click", () => {
      window.location.href = "/login";
    });

    return;
  }

  try {
    const res = await fetch(`https://train-track-backend.onrender.com/user/profile/${userId}`);
    const data = await res.json();
    const user = data.user;

    document.getElementById("welcomeBanner").style.display = "block";
    document.getElementById("welcomeName").textContent = user.full_name || "Friend";
    document.getElementById("profileName").textContent = user.full_name || "Graduation Project";

    const avatar = document.getElementById("avatarCircle");
    if (user.avatar) {
      avatar.style.backgroundImage = `url('${user.avatar}')`;
      avatar.style.backgroundSize = "cover";
      avatar.style.backgroundPosition = "center";
      avatar.textContent = "";
    } else {
      avatar.textContent = (user.full_name && user.full_name[0]) || "G";
    }
  } catch (err) {
    console.error("⚠️ Profile load error:", err);
  }

  try {
    const res = await fetch(`https://train-track-backend.onrender.com/user/profile/trials/${userId}`);
    const data = await res.json();
    allTrials = data.trials;
    renderTrials(allTrials);
  } catch (err) {
    console.error("⚠️ Trail load error:", err);
  }
});

document.getElementById("startNewTrialBtn")?.addEventListener("click", function (e) {
  e.preventDefault();
  localStorage.clear();
  window.location.href = "/traintrack/start";
});

document.getElementById("logoutBtn")?.addEventListener("click", function (e) {
  e.preventDefault();
  fetch("https://train-track-backend.onrender.com/user/logout", {
    method: "GET",
    credentials: "include"
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        localStorage.clear();
        window.location.href = "/";
      } else {
        alert("Logout failed.");
      }
    })
    .catch(err => {
      console.error("❌ Logout error:", err);
      alert("Network error.");
    });
});

document.getElementById("sortTrials")?.addEventListener("change", function () {
  const value = this.value;
  let sorted = [...allTrials];
  if (value === "latest") sorted.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
  else if (value === "oldest") sorted.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
  else if (value === "updated") sorted.sort((a, b) => new Date(b.last_updated) - new Date(a.last_updated));
  renderTrials(sorted);
});

function renderTrials(trials) {
  const trailContainer = document.getElementById("trailContainer");
  trailContainer.innerHTML = "";

  trials.forEach(trial => {
    const div = document.createElement("div");
    div.className = "trail-card";

    const createdAt = new Date(trial.created_at);
    const updatedAt = new Date(trial.last_updated);
    const formattedDate = createdAt.toLocaleDateString(undefined, {
      year: "numeric", month: "short", day: "numeric"
    });

    const timeDiffDays = Math.floor((Date.now() - updatedAt.getTime()) / (1000 * 60 * 60 * 24));
    const updatedLabel = timeDiffDays === 0 ? "Today" :
      timeDiffDays === 1 ? "1 day ago" : `${timeDiffDays} days ago`;

    const labelClass = trial.status_class || (trial.is_submitted ? "completed" : "incomplete");
    const labelText = trial.status_label || (trial.is_submitted ? "Completed" : "Incomplete");

    const trailLink = trial.is_submitted
      ? `/summary/${trial.id}`
      : `/wizard/fallback/improve?trial_id=${trial.id}`;

    div.innerHTML = `
      <div>
        <span><strong>Trail #${trial.id}</strong> — ${formattedDate}</span><br>
        <a href="${trailLink}" class="summary-link ${!trial.is_submitted ? "continue-trial" : ""}" data-trial-id="${trial.id}">
          🔗 ${trial.is_submitted ? "View Summary" : "Continue Trial"}
        </a>
        <div class="last-updated">🕒 Last updated: ${updatedLabel}</div>
      </div>
      <div class="status-actions">
        <div class="status-pill status-${labelClass}">${labelText}</div>
        <button class="delete-trial-btn" data-trial-id="${trial.id}" title="Delete Trial">❌</button>
      </div>
    `;

    trailContainer.appendChild(div);
  });

  document.querySelectorAll(".delete-trial-btn").forEach(btn => {
    btn.addEventListener("click", async () => {
      const trialId = btn.dataset.trialId;
      if (!confirm(`Are you sure you want to delete Trial #${trialId}?`)) return;

      try {
        const res = await fetch(`https://train-track-backend.onrender.com/user/results/${trialId}`, {
          method: "DELETE",
          credentials: "include"
        });
        const result = await res.json();
        if (res.ok && result.success) {
          alert("✅ Trial deleted successfully.");
          btn.closest(".trail-card").remove();
        } else {
          alert("❌ Delete failed.");
        }
      } catch (err) {
        console.error("⚠️ Delete error:", err);
        alert("⚠️ Network issue.");
      }
    });
  });

  document.querySelectorAll(".continue-trial").forEach(link => {
    link.addEventListener("click", async (e) => {
      e.preventDefault();
      const trialId = link.dataset.trialId;

      try {
        const res = await fetch("https://train-track-backend.onrender.com/trial-resume", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ trial_id: parseInt(trialId) })
        });

        const result = await res.json();
        if (result.success && result.data) {
          const selections = result.data;
          localStorage.setItem("wizard_selections", JSON.stringify(selections));

          if (selections.subject_categories)
            localStorage.setItem("subject_categories", JSON.stringify(selections.subject_categories));

          if (selections.subjects)
            localStorage.setItem("selected_subjects", JSON.stringify(selections.subjects));

          if (selections.technical_skills)
            localStorage.setItem("technical_skills", JSON.stringify(selections.technical_skills));

          if (selections.non_technical_skills)
            localStorage.setItem("non_technical_skills", JSON.stringify(selections.non_technical_skills));

          const step = result.data.last_step || "traintrack";
          const redirectMap = {
            "subject": "/traintrack",
            "subject2": "/traintrack/subject2",
            "technical": "/traintrack/technical",
            "nontechnical": "/traintrack/nontechnical",
            "advancepreferences": "/traintrack/advancepreferences"
          };

          window.location.href = redirectMap[step] || "/traintrack";
        } else {
          alert("⚠️ Couldn't load saved trial.");
        }
      } catch (err) {
        console.error("❌ Resume trial error:", err);
        alert("⚠️ Failed to resume trial.");
      }
    });
  });
}
