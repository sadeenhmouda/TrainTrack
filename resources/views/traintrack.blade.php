<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Train Track Wizard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
</head>

<body class="wizard-body">
  <div class="wizard-layout">
    {{-- Left Sidebar --}}
     @include('traintrack.partials.sidebar', [
      'currentStep' => 1,
  'currentSubstep' => null
])

    {{-- Right Form Area --}}
    <div class="form-area">
      <h1 class="form-title">👋 Let’s Get to Know You</h1>
      <p class="form-subtitle">Please fill out your personal information below</p>

      <form>
        <!-- Full Name -->
        <div class="form-group">
          <label for="fullName">Full Name</label>
          <input type="text" id="fullName" placeholder="Enter your full name">
        </div>

        <!-- Gender -->
        <div class="form-group">
          <label>Gender</label>
          <div class="button-group">
            <button type="button" class="option-button">🧔 Male</button>
            <button type="button" class="option-button">👩 Female</button>
          </div>
        </div>

        <!-- Date of Birth -->
        <div class="form-group dob-group">
          <label class="dob-label">Date of Birth</label>
          <div class="dob-selects" style="display: flex; gap: 10px;">
            <select id="dob-month" required>
              <option value="" disabled selected>Month</option>
            </select>

            <select id="dob-day" required>
              <option value="" disabled selected>Day</option>
            </select>

            <select id="dob-year" required>
              <option value="" disabled selected>Year</option>
            </select>
          </div>
        </div>

        <!-- Major -->
        <div class="form-group">
          <label>Major</label>
          <div class="major-options" id="majorOptions">
            <!-- JS will populate major pills here -->
          </div>
        </div>

        <!-- Submit -->
        <div class="form-buttons">
          <button type="submit" class="next">Next</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/alert.js') }}"></script>

  <script>
    // ✅ Populate Date Options
    const daySelect = document.getElementById("dob-day");
    for (let i = 1; i <= 31; i++) {
      const d = i.toString().padStart(2, "0");
      daySelect.innerHTML += `<option value="${d}">${d}</option>`;
    }

    const monthSelect = document.getElementById("dob-month");
    const months = [
      "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
    ];
    months.forEach((m, i) => {
      const val = (i + 1).toString().padStart(2, "0");
      monthSelect.innerHTML += `<option value="${val}">${m}</option>`;
    });

    const yearSelect = document.getElementById("dob-year");
    const currentYear = new Date().getFullYear();
    for (let y = currentYear; y >= 1990; y--) {
      yearSelect.innerHTML += `<option value="${y}">${y}</option>`;
    }

    // ✅ Major Options
    fetch("https://train-track-backend.onrender.com/wizard/majors")
      .then(res => res.json())
      .then(result => {
        if (result.success && result.data) {
          const majorOptionsDiv = document.getElementById("majorOptions");
          majorOptionsDiv.innerHTML = "";
          const emojiMap = {
            "Computer Science Apprenticeship Program": "🧑‍💻",
            "Management Information Systems": "💼",
            "Computer Science": "💻",
            "Cyber Security": "🔐",
            "Computer Engineering": "🛠️",
            "Network Information System": "🌐"
          };

          result.data.forEach(major => {
            const pill = document.createElement("span");
            pill.classList.add("major-pill");
            pill.dataset.id = major.id;
            pill.textContent = `${emojiMap[major.name] || "🎓"} ${major.name}`;
            majorOptionsDiv.appendChild(pill);
          });

          document.querySelectorAll(".major-pill").forEach(pill => {
            pill.addEventListener("click", () => {
              document.querySelectorAll(".major-pill").forEach(p => p.classList.remove("selected"));
              pill.classList.add("selected");
            });
          });
        }
      });

    // ✅ Gender toggle
    document.querySelectorAll(".option-button").forEach(btn => {
      btn.addEventListener("click", () => {
        document.querySelectorAll(".option-button").forEach(b => b.classList.remove("selected"));
        btn.classList.add("selected");
      });
    });

    // ✅ Save Personal Info on Next
    document.querySelector(".next")?.addEventListener("click", function (e) {
      e.preventDefault();

      const fullName = document.getElementById("fullName").value.trim();
      const genderBtn = document.querySelector(".option-button.selected");
      const majorPill = document.querySelector(".major-pill.selected");

      const day = document.getElementById("dob-day").value;
      const month = document.getElementById("dob-month").value;
      const year = document.getElementById("dob-year").value;

      if (!fullName || !genderBtn || !majorPill || !day || !month || !year) {
        Swal.fire("Error", "Please fill in all fields.", "error");
        return;
      }

      const gender = genderBtn.textContent.trim().replace(/^[^\w]+/, "");
      const majorId = majorPill.dataset.id;
      const dob = `${year}-${month}-${day}`;

      // ✅ Save to localStorage (Advanced Page needs these!)
      localStorage.setItem("fullName", fullName);
      localStorage.setItem("gender", gender);
      localStorage.setItem("majorId", majorId);
      localStorage.setItem("dateOfBirth", dob);

      // ✅ Optional: Save as full object
      const formData = {
        full_name: fullName,
        gender,
        date_of_birth: dob,
        major_id: majorId
      };
      localStorage.setItem("personal_info", JSON.stringify(formData));

      console.log("✅ Saved personal info:", formData);

      window.location.href = "/traintrack/subject";
    });
  </script>
</body>
</html>
