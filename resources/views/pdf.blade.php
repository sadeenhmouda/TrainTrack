<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TrainTrack PDF Report</title>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      padding: 40px;
      color: #333;
    }
    .header {
      text-align: center;
      margin-bottom: 20px;
    }
    .logo {
      width: 160px;
      margin-bottom: 10px;
    }
    h1 {
      color: #6A1B9A;
      font-size: 28px;
      margin-bottom: 5px;
    }
    .sub {
      font-size: 16px;
      color: #777;
      margin-bottom: 20px;
    }
    .section {
      margin-bottom: 30px;
    }
    .section h2 {
      font-size: 20px;
      color: #6A1B9A;
      margin-bottom: 10px;
    }
    .label {
      font-weight: bold;
    }
    .bar-container {
      background-color: #ddd;
      border-radius: 20px;
      width: 100%;
      height: 15px;
      margin-top: 4px;
      margin-bottom: 10px;
    }
    .bar-fill {
      height: 100%;
      border-radius: 20px;
      background-color: #6A1B9A;
    }
    .company {
      margin-bottom: 10px;
    }
    .footer {
      text-align: right;
      margin-top: 40px;
      font-size: 13px;
      color: #666;
    }
  </style>
</head>
<body>

  <div class="header">
    <img src="{{ public_path('images/traintrack-logo.png') }}" class="logo" alt="TrainTrack Logo">
    <h1>Summary & Results</h1>
    <p class="sub">✨ The right track starts here ✨</p>
  </div>

  <div class="section">
    <h2>👤 Student Info</h2>
    <p><span class="label">Name:</span> {{ $user['fullName'] }}</p>
    <p><span class="label">Gender:</span> {{ $user['gender'] }}</p>
    <p><span class="label">Major:</span> {{ $user['major'] }}</p>
  </div>

  <div class="section">
    <h2>🎯 You're on track for: <span style="color:#000">{{ $position['title'] }}</span></h2>

    <p class="label">📘 Subject Match: {{ $position['subject'] }}%</p>
    <div class="bar-container"><div class="bar-fill" style="width: {{ $position['subject'] }}%"></div></div>

    <p class="label">💻 Technical Skill: {{ $position['technical'] }}%</p>
    <div class="bar-container"><div class="bar-fill" style="width: {{ $position['technical'] }}%"></div></div>

    <p class="label">💬 Soft Skills: {{ $position['non_technical'] }}%</p>
    <div class="bar-container"><div class="bar-fill" style="width: {{ $position['non_technical'] }}%"></div></div>

    <p class="label">🎯 Overall Match: {{ $position['score'] }}%</p>
    <div class="bar-container"><div class="bar-fill" style="width: {{ $position['score'] }}%"></div></div>
  </div>

  <div class="section">
    <h2>🏢 Matching Companies</h2>
    @if(count($companies) > 0)
      @foreach($companies as $company)
        <div class="company">
          <strong>{{ $company['name'] }}</strong><br>
          📍 {{ $company['location'] }}<br>
          🏛 Industry: {{ $company['industry'] }}<br>
          🧱 Size: {{ $company['size'] }}
        </div>
      @endforeach
    @else
      <p>No companies matched your preferences.</p>
    @endif
  </div>

  <div class="footer">
    📄 Exported on: {{ now()->format('F j, Y – h:i A') }}
  </div>

</body>
</html>
