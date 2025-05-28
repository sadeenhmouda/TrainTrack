const userId = new URLSearchParams(window.location.search).get("user_id");

document.addEventListener("DOMContentLoaded", async function () {
  if (!userId) {
    console.error("❌ user_id not found in URL");
    return;
  }

  const savedUserId = localStorage.getItem("user_id");
  const isGuest = localStorage.getItem("is_guest");
  const trailContainer = document.getElementById("trailContainer");

  // 🚫 Guest or mismatched session
  if (isGuest === "true" || savedUserId !== userId) {
    localStorage.clear();
    trailContainer.innerHTML = `
      <div style="text-align:center; padding:40px;">
        <p>🚀 You haven’t started any training journeys yet!</p>
        <p>Click <strong>“Start New Trial”</strong> to begin exploring opportunities!</p>
      </div>
    `;
    return;
  }

  // ✅ Load user profile
  try {
    const res = await fetch(`https://train-track-backend.onrender.com/user/profile/${userId}`, {
      credentials: "include"
    });
    const data = await res.json();
    if (!res.ok || !data.success) throw new Error("Profile fetch failed.");
    const user = data.user;

    const isEmptyProfile = !user.full_name || !user.major_id || !user.gender;

    if (isEmptyProfile) {
      document.getElementById("welcomeBanner").style.display = "block";
      document.getElementById("welcomeName").textContent = "Friend";
      document.querySelector(".user-details").innerHTML = `
        <h2>Welcome, new friend! 👋</h2>
        <p>It looks like you haven’t completed your profile yet.</p>
        <div class="action-buttons">
          <a href="/traintrack" class="btn-primary">🎓 Complete My Profile</a>
        </div>
      `;
      return;
    }

    // ✅ Show profile name — FORCED "Graduation Project"
    document.getElementById("profileName").textContent = "Graduation Project";

    // ✅ Avatar logic
    const avatar = document.getElementById("avatarCircle");
    if (user.avatar) {
      avatar.style.backgroundImage = `url('${user.avatar}')`;
      avatar.style.backgroundSize = "cover";
      avatar.style.backgroundPosition = "center";
      avatar.textContent = "";
    } else {
      avatar.textContent = "G";
    }

    // ✅ Show welcome
    document.getElementById("welcomeBanner").style.display = "block";
    document.getElementById("welcomeName").textContent = "Graduation";
  } catch (err) {
    console.error("⚠️ Profile load error:", err);
  }

  // ✅ Load training trails
  try {
    const res = await fetch(`https://train-track-backend.onrender.com/user/profile/trials/${userId}`, {
      credentials: "include"
    });
    const data = await res.json();

    if (!res.ok || !data.success || data.trials.length === 0) {
      trailContainer.innerHTML = `
        <div style="text-align:center; padding:40px;">
          <p>🚀 You haven’t started any training journeys yet!</p>
          <p>Click <strong>“Start New Trial”</strong> to begin exploring opportunities!</p>
        </div>
      `;
      return;
    }

    // ✅ Show all trails
    data.trials.forEach(trial => {
      const div = document.createElement("div");
      div.className = "trail-card";

      const createdAt = new Date(trial.created_at);
      const updatedAt = new Date(trial.last_updated);
      const formattedDate = createdAt.toLocaleDateString(undefined, {
        year: "numeric", month: "short", day: "numeric"
      });

      const timeDiffDays = Math.floor((Date.now() - updatedAt.getTime()) / (1000 * 60 * 60 * 24));
      const updatedLabel = timeDiffDays === 0 ? "Today" :
        timeDiffDays === 1 ? "1 day ago" :
        `${timeDiffDays} days ago`;

      const labelClass = trial.status_class || (trial.is_submitted ? "completed" : "incomplete");
      const labelText = trial.status_label || (trial.is_submitted ? "Completed" : "Incomplete");

      const trailLink = trial.is_submitted
        ? `/summary/${trial.id}`
        : `/wizard/fallback/improve?trial_id=${trial.id}`;

      div.innerHTML = `
        <div>
          <span><strong>Trail #${trial.id}</strong> — ${formattedDate}</span><br>
          <a href="${trailLink}" class="summary-link">🔗 View ${trial.is_submitted ? "Summary" : "Resume"}</a>
          <div class="last-updated">🕒 Last updated: ${updatedLabel}</div>
        </div>
        <div class="status-actions">
          <div class="status-pill status-${labelClass}">${labelText}</div>
          <button class="delete-trial-btn" data-trial-id="${trial.id}" title="Delete Trial">❌</button>
        </div>
      `;

      trailContainer.appendChild(div);
    });

    // ✅ Delete button logic
    document.querySelectorAll(".delete-trial-btn").forEach(btn => {
      btn.addEventListener("click", async () => {
        const trialId = btn.dataset.trialId;
        if (!confirm(`Are you sure you want to delete Trial #${trialId}?`)) return;

        try {
          const res = await fetch(`https://train-track-backend.onrender.com/user/trials/${trialId}`, {
            method: "DELETE",
            credentials: "include"
          });
          const result = await res.json();

          if (res.ok && result.success) {
            alert("✅ Trial deleted successfully.");
            btn.closest(".trail-card").remove();
          } else {
            alert("❌ Failed to delete: " + result.message);
          }
        } catch (err) {
          console.error("⚠️ Error deleting trial:", err);
          alert("⚠️ Network or server error while deleting trial.");
        }
      });
    });
  } catch (err) {
    console.error("⚠️ Trail load error:", err);
  }
});

// ✅ Attach Start New Trial button click
document.addEventListener("click", function (e) {
  const btn = e.target.closest("#startNewTrialBtn");
  if (btn) {
    e.preventDefault();
    localStorage.clear();
    window.location.href = "/traintrack/start";
  }
});
