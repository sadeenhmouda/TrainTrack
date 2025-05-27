<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up | Train Track</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
  <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>
<body>

<div class="signup-container">
  <!-- LEFT IMAGE -->
  <div class="left-image-section">
    <img src="{{ asset('signup-art.webp') }}" alt="Signup Illustration" /> 
  </div>

  <!-- RIGHT FORM -->
  <div class="right-form-section">
    <div class="form-box animate-slide">
      <h1>Sign up to <span>Train Track</span></h1>

      <!-- Google Sign-In Button -->
      <div id="googleSignInBtn" style="margin-bottom: 20px;"></div>

      <div class="divider"><span>or</span></div>

      <!-- Guest Mode -->
      <button class="guest-btn" id="guestBtn">Continue as Guest</button>

      <p class="login-note">
        Already have an account? <a href="/login">Log In</a>
      </p>
    </div>
  </div>
</div>

<script src="{{ asset('js/signup.js') }}" defer></script>

</body>
</html>