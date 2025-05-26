<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      background: #f3f0ff;
      font-family: 'Segoe UI', sans-serif;
    }

    .layout {
      display: flex;
      min-height: 100vh;
    }

    .sidebar {
      width: 250px;
      background: linear-gradient(to bottom, #c9a7f3, #f3f0ff);
      color: white;
      padding: 30px 20px;
      border-top-right-radius: 40px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .sidebar h2 {
      font-size: 22px;
      text-align: center;
      margin-bottom: 40px;
      color: white;
    }

    .menu-item {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 15px;
      padding: 10px;
      border-radius: 30px;
      cursor: pointer;
      transition: background 0.3s;
      color: white;
    }

    .menu-item:hover,
    .menu-item.active {
      background: white;
      color: #6a1b9a;
    }

    .menu-item i {
      font-size: 14px;
    }

    .logo {
      width: 100%;
      margin-top: 40px;
      border-radius: 16px;
    }

    .main-content {
      flex-grow: 1;
      padding: 40px;
    }

    .profile-card {
      display: flex;
      align-items: center;
      background: white;
      border-radius: 20px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
      padding: 24px;
      margin-bottom: 40px;
    }

    .profile-img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-right: 24px;
    }

    .profile-info {
      line-height: 1.6;
    }

    .profile-info h3 {
      margin: 0 0 8px;
      font-size: 20px;
      color: #6a1b9a;
    }

    .profile-info p {
      margin: 4px 0;
      color: #444;
      font-size: 14px;
    }

    .timeline-card {
      background: white;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
    }

    .timeline-title {
      font-size: 18px;
      margin-bottom: 20px;
    }

    .course {
      background: linear-gradient(to right, #c2b7e8, #e5e1f7);
      border-left: 6px solid #7b59e0;
      border-radius: 12px;
      padding: 16px;
      margin-bottom: 16px;
      position: relative;
      color: #333;
    }

    .course h4 {
      margin: 0 0 6px;
    }

    .course p {
      margin: 0;
      font-size: 13px;
    }

    .status {
      position: absolute;
      top: 16px;
      right: 16px;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      color: white;
      font-weight: bold;
    }

    .status.completed {
      background: #f7941d;
    }

    .status.ongoing {
      background: #3b3fbb;
    }

    .status.upcoming {
      background: #8e44ad;
    }
  </style>
</head>
<body>
  <div class="layout">
    <aside class="sidebar">
      <div>
        <h2>Profile</h2>
        <div class="menu-item active"><i class="fas fa-user"></i> Profile</div>
        <div class="menu-item"><i class="fas fa-book"></i> My Courses</div>
        <div class="menu-item"><i class="fas fa-check-circle"></i> Completed</div>
        <div class="menu-item"><i class="fas fa-calendar"></i> Events</div>
        <div class="menu-item"><i class="fas fa-trophy"></i> Achievements</div>
        <div class="menu-item"><i class="fas fa-clock"></i> Schedule</div>
        <div class="menu-item"><i class="fas fa-comment-dots"></i> Messages</div>
      </div>
      <img src="{{ asset('logo22.png') }}" alt="Logo" class="logo">
    </aside>

    <main class="main-content">
      <!-- ✅ USER PROFILE CARD -->
      <section class="profile-card">
        <img id="profileImage" src="https://i.pravatar.cc/120" alt="Profile" class="profile-img">
        <div class="profile-info">
          <h3 id="profileName">Loading...</h3>
          <p id="profileMajor">...</p>
          <p id="profileEmail">Email: ...</p>
          <p id="profilePhone">Phone: ...</p>
        </div>
      </section>

      <!-- ✅ COURSE LIST -->
      <section class="timeline-card">
        <h3 class="timeline-title">My Courses</h3>
        <div id="courseContainer"></div>
      </section>
    </main>
  </div>

  <script>
document.addEventListener("DOMContentLoaded", function () {
  const userId = localStorage.getItem("user_id");
  const guestId = localStorage.getItem("guest_id");

  // 🔄 Choose the correct API based on what's available
  let apiURL = "";

  if (userId && !guestId) {
    apiURL = `https://train-track-backend.onrender.com/user/profile/${userId}`;
  } else if (guestId) {
    apiURL = `https://train-track-backend.onrender.com/user/profile/${guestId}`;
  } else {
    apiURL = `https://train-track-backend.onrender.com/user/results`; // fallback
  }

  fetch(apiURL)
    .then(res => res.json())
    .then(data => {
      // ✅ PROFILE INFO
      document.getElementById("profileName").textContent = data.name || "Guest User";
      document.getElementById("profileMajor").textContent = data.major || "Unknown Major";
      document.getElementById("profileEmail").textContent = "Email: " + (data.email || "N/A");
      document.getElementById("profilePhone").textContent = "Phone: " + (data.phone || "N/A");

      // ✅ PROFILE IMAGE (Optional fallback)
      if (data.profile_image) {
        document.getElementById("profileImage").src = data.profile_image;
      }

      // ✅ COURSES SECTION
      const container = document.getElementById("courseContainer");
      container.innerHTML = "";

      (data.courses || []).forEach(course => {
        const div = document.createElement("div");
        div.className = "course";
        div.innerHTML = `
          <h4>${course.title}</h4>
          <p>${course.description}</p>
          <span class="status ${course.status_class}">${course.status_label}</span>
        `;
        container.appendChild(div);
      });
    })
    .catch(err => {
      console.error("❌ Failed to fetch user profile:", err);
    });
});
</script>
</body>
</html>
