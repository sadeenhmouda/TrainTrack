const userId = localStorage.getItem("userId");
if (!userId) {
  console.warn("⚠️ No user ID found in localStorage");
}
document.addEventListener("DOMContentLoaded", function () {
  const guestBtn = document.getElementById("guestBtn");

  if (guestBtn) {
    guestBtn.addEventListener("click", () => {
      fetch("https://train-track-backend.onrender.com/user/guest")
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            localStorage.setItem("user_id", data.user_id);
            localStorage.setItem("is_guest", "true");
            window.location.href = "/";
          } else {
            alert("❌ Guest login failed.");
          }
        })
        .catch(err => {
          console.error("❌ Guest login error:", err);
          alert("❌ Error connecting to server.");
        });
    });
  }

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
});
