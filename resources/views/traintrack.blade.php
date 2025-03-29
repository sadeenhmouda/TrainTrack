<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Let's Get to know you </title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      background-color: #8B5CF6 ; 
      font-family: 'Roboto', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .frame {
      width:800px;
      height:550px;
      background-color: #fff;
      display: flex;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    .left-side {
      width: 35%;
      background-color: #f9f9f9;
      padding: 40px 30px;
    }
    .left-side .logo {
      font-size: 18px;
      font-weight: bold;
      color: #6C3EBF;
      margin-bottom: 20px;
      cursor: pointer;
    }
    .left-side .progress-title {
      font-weight: bold;
      font-size: 20px;
      margin-bottom: 20px;
      color :#ff914d;
    }
    .stepper {
      display: flex;
      flex-direction: column;
      gap: 25px;
      position: relative;
    }
    .step {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      color: #999;
      font-size: 18px;
      position: relative;
    }
    .step .circle {
      width: 16px;
      height: 16px;
      border-radius: 50%;
      background-color: #ddd;
      flex-shrink: 0;
      margin-top: 2px;
    }
    .step.active .circle {
      background-color: #6C3EBF;
    }
    .step.active .label {
      font-weight: bold;
      color: #333;
    }
    .step:not(:last-child)::after {
      content: '';
      position: absolute;
      top: 20px;
      left: 7px;
      width: 2px;
      height: 30px;
      background-color: #ccc;
    }
    .right-side {
      flex: 1;
      padding: 60px 50px;
      position: relative;
    }
    .step-title {
      font-size:26px;
    font-weight: bold;
      margin-bottom: 40px;
      color: #ff914d;
    }
    label {
      display: block;
      font-size: 20px;
      margin-bottom: 6px;
      color: #333;
    }
    input[type="text"] {
      width: 100%;
      max-width: 400px;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      margin-bottom: 30px;
    }
    .icons {
      display: flex;
      gap: 20px;
      margin-top: 10px;
    }
    .icon-label {
      display: flex;
      align-items: center;
      gap: 8px;
      background-color: #f0f0f0;
      padding: 12px 20px;
      border-radius: 30px;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: 0.3s;
    }
    .icon-label:hover {
      background-color: #e0e0e0;
    }
    .buttons {
      position: absolute;
      bottom: 40px;
      left: 50px;
      right: 50px;
      display: flex;
      gap: 20px;
      
    }
    .btn {
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      color: #F59E0B;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
    }
    .btn:hover {
      background-color: #e09a00;
    }
  </style>
</head>
<body>
  <div class="frame">
    <div class="left-side">
     <div class="logo" onclick="location.href='index.html'">
  <img src="public\ttlogo.jpg" style="width: 200px;">
</div>

      <div class="progress-title">Wizard Progress</div>
      <div class="stepper">
        <div class="step active">
          <div class="circle"></div>
          <div class="label">Let’s Get to Know You</div>
        </div>
        <div class="step">
          <div class="circle"></div>
          <div class="label">Subject of Interest</div>
        </div>
        <div class="step">
          <div class="circle"></div>
          <div class="label">Technical Skills</div>
        </div>
        <div class="step">
          <div class="circle"></div>
          <div class="label">Non-Technical Skills</div>
        </div>
        <div class="step">
          <div class="circle"></div>
          <div class="label">Training Mode</div>
        </div>
        <div class="step">
          <div class="circle"></div>
          <div class="label">Advanced Preferences</div>
        </div>
        <div class="step">
          <div class="circle"></div>
          <div class="label">Summary</div>
        </div>
        <div class="step">
          <div class="circle"></div>
          <div class="label">Results</div>
        </div>
      </div>
    </div>
    <div class="right-side">
      <div class="step-title">📝 Let's Get to know you</div>
      <form> 
        <label for="name">Name:</label>
        <input type="text" id="name" placeholder="Enter your name" />
        <label for="major">Major:</label>
        <div class="icons">
          <div class="icon-label"><span>🧢</span> CAP</div>
          <div class="icon-label"><span>🎓</span> MIS</div>
        </div>
      </form>
      <br><br><br>
      <div class="buttons">
        <button class="btn" style="margin-right: auto;">Back</button>
         <a href="{{ route('traintrack.subject') }}" <button class="btn">Next</button>
                Next
            </a>
      </div>
    </div>
  </div>
</body>
</html>

   