document.addEventListener("DOMContentLoaded", function () {
  const guestBtn = document.getElementById("guestBtn");

  // ✅ Clear old wizard or trial data
  const keysToClear = [
    "finalWizardData", "recommendationResult", "fallbackTriggered", "previousFallbackPayload",
    "fullName", "gender", "majorId", "selectedSubjectIds", "selectedSubjectCategoryIds",
    "selectedTechnicalSkills", "selectedNonTechnicalSkills",
    "trainingModeId", "trainingModeDesc", "companySizeId", "companySizeDesc",
    "industryIds", "selectedIndustryNames", "companyCulture", "cultureMap",
    "user_id", "is_guest"
  ];
  keysToClear.forEach(key => localStorage.removeItem(key));

  // ✅ Guest Mode: Redirect directly to home/start
  if (guestBtn) {
    guestBtn.addEventListener("click", () => {
      localStorage.setItem("is_guest", "true"); // optional: track guest mode
      window.location.href = "/traintrack/start"; // your wizard start route
    });
  }

  // ✅ Google Sign-In (Redirect Mode)
  window.onload = function () {
    google.accounts.id.initialize({
      client_id: "122216480872-belaanl5ifilncshj243le3aasskuphe.apps.googleusercontent.com",
      ux_mode: "redirect",
      login_uri: "https://train-track-backend.onrender.com/user/google-login"
    });

    google.accounts.id.renderButton(
      document.getElementById("googleSignInBtn"),
      {
        theme: "filled_black",
        size: "large",
        shape: "pill",
        text: "signup_with"
      }
    );
  };
});
