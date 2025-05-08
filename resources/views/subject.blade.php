<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Train Track Wizard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/subjectcategories.css') }}">
</head>

<body class="wizard-body">
  <div class="wizard-layout">
    {{-- Left Sidebar --}}
    @include('traintrack.partials.sidebar')

    <!-- Right Side -->
    <div class="subject-form">
      <h1>🧠 Knowledge Background</h1>
      <p>Select max 3 categories to get personalized subject suggestions</p>

      <div class="subject-category-grid" id="categoryGrid"></div>

      <div class="subject-buttons">
        <a href="{{ route('traintrack') }}">
          <button class="btn-back">Back</button>
        </a>
        <button class="btn-next" id="nextBtn" disabled>Next</button>
      </div>
    </div>
  </div>

  <!-- ✅ Inject next route as global JS variable -->
  <script>
    window.nextRoute = "{{ route('traintrack.subject2') }}";
  </script>

  <!-- ✅ Load external JavaScript logic -->
  <script src="{{ asset('js/subjectcategories.js') }}"></script>
</body>
</html>
