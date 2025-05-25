document.addEventListener("DOMContentLoaded", function () {
  const guestBtn = document.getElementById("guestBtn");

  // ✅ Guest Login
  if (guestBtn) {
    guestBtn.addEventListener("click", () => {
      fetch("https://train-track-backend.onrender.com/user/guest")
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            localStorage.setItem("user_id", data.user_id);
            localStorage.setItem("is_guest", "true"); // ✅ mark as guest
            window.location.href = "/"; // ✅ Home Page
          } else {
            alert("❌ Guest login failed.");
          }
        })
        .catch(err => {
          alert("❌ Error connecting to server.");
          console.error(err);
        });
    });
  }

  // ✅ Google Redirect Sign-In
  window.onload = function () {
    google.accounts.id.initialize({
      client_id: "122216480872-belaanl5ifilncshj243le3aasskuphe.apps.googleusercontent.com",
      ux_mode: "redirect", // ✅ switch from popup to redirect
      login_uri: "https://train-track-backend.onrender.com/user/google-login" // ✅ must match Google Console
    });

    // Render button visually (but this will trigger redirect)
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
