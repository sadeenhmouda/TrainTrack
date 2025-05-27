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
  <div class="left-image-section">
    <img src="{{ asset('signup-art.webp') }}" alt="Login Illustration" />
  </div>

  <div class="right-form-section">
    <div class="form-box animate-slide">
      <h1>Welcome back to <span>Train Track</span></h1>

      <!-- ✅ Google Sign-In Button Only -->
      <div id="googleSignInBtn" style="margin-bottom: 20px;"></div>

      <!-- ❌ No Guest Button Here -->
    </div>
  </div>
</div>

<script src="{{ asset('js/login.js') }}" defer></script>

</body>
</html>