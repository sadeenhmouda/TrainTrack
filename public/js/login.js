const userId = localStorage.getItem("userId");
if (!userId) {
  console.warn("⚠️ No user ID found in localStorage");
}
document.addEventListener("DOMContentLoaded", function () {
  // ✅ Google Sign-In with redirect mode
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
      text: "signin_with"
    }
  );
});
