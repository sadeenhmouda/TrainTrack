<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Train Track</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>
<body>

<div class="signup-container">
  <!-- 🖼️ Left Side Image -->
  <div class="left-image-section"></div>

  <!-- 📦 Right Side Form -->
  <div class="right-form-section">
    <div class="form-box">
      <h1>Welcome back to <span>Train Track</span></h1>

      <!-- ✅ Google Sign-In -->
      <div id="googleSignInBtn"></div>

      <!-- 🔁 Sign up redirect -->
      <p class="login-note">
        Don’t have an account? <a href="/signup">Sign up</a>
      </p>
    </div>
  </div>
</div>

<script src="{{ asset('js/login.js') }}" defer></script>

</body>
</html>