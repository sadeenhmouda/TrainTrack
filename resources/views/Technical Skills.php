
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Technical Skills Wizard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <!-- Frame Container -->
  <div class="w-[1024px] h-[800px] bg-white rounded-2xl shadow-xl flex overflow-hidden">

    <div class="w-2/5 bg-[#f9f9f9] px-10 py-8">
        <!-- Logo Image at the top -->
        <img src="assets/logo.png" alt="Train Track Logo" class="w-[250px] h-[100px]" />
    
        <div class="text-gray-700 font-semibold text-base border-b border-gray-200 pb-2 mb-6">
            Step Guide
          </div>
          
          

      <div class="flex flex-col gap-6 relative">
        <!-- Vertical line -->
        <div class="absolute left-3 top-5 bottom-5 w-1 bg-gray-200 z-0"></div>

        <!-- Step 1 -->
        <div class="flex items-center gap-3 relative z-10">
          <div class="w-8 h-8 flex items-center justify-center rounded-full bg-purple-700 text-white text-sm font-semibold border-2 border-purple-700">1</div>
          <span class="text-gray-800 font-medium">Let's Get to Know You</span>
        </div>

        <!-- Step 2 -->
        <div class="flex items-center gap-3 relative z-10">
          <div class="w-8 h-8 flex items-center justify-center rounded-full bg-purple-700 text-white text-sm font-semibold border-2 border-purple-700">2</div>
          <span class="text-gray-800 font-medium">Subject of Interest</span>
        </div>

        <!-- Step 3 -->
        <div class="flex items-center gap-3 relative z-10">
          <div class="w-8 h-8 flex items-center justify-center rounded-full bg-white text-purple-700 text-sm font-semibold border-2 border-purple-700">3</div>
          <span class="text-purple-700 font-semibold">Technical Skills</span>
        </div>

        <!-- Step 4 -->
        <div class="flex items-center gap-3 relative z-10">
          <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 text-gray-500 text-sm font-semibold">4</div>
          <span class="text-gray-500">Non-technical Skills</span>
        </div>

        <!-- Step 5 -->
        <div class="flex items-center gap-3 relative z-10">
          <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 text-gray-500 text-sm font-semibold">5</div>
          <span class="text-gray-500">Advanced Preferences</span>
        </div>

        <!-- Step 6 -->
        <div class="flex items-center gap-3 relative z-10">
          <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 text-gray-500 text-sm font-semibold">6</div>
          <span class="text-gray-500">Summary</span>
        </div>

        <!-- Step 7 -->
        <div class="flex items-center gap-3 relative z-10">
          <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 text-gray-500 text-sm font-semibold">7</div>
          <span class="text-gray-500">Result</span>
        </div>
      </div>
    </div>

    <!-- Right Side (Content) -->
    <!-- (unchanged content remains here...) -->

    <!-- Right Side (Content) -->
    <div class="w-3/5 p-10 overflow-y-auto">
      <h2 class="text-2xl font-bold text-purple-700 mb-2">🛠️ Technical Skills</h2>
      <p class="text-sm text-gray-600 mb-6">Explore the section below and choose your technical skills.</p>

      <!-- Accordion: Programming & Logic -->
      <div class="border rounded-lg mb-4 overflow-hidden">
        <button onclick="toggleAccordion(this)" class="w-full flex justify-between items-center px-4 py-3 bg-purple-100 text-purple-700 font-semibold">
          Programming & Logic
          <span class="text-lg">+</span>
        </button>
        <div class="accordion-content hidden px-4 pb-4 pt-2">
          <div class="flex flex-col gap-3">
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Knowledge of OOP</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Knowledge of algorithms</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Knowledge of data structures</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Logical Thinking</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Programming</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Strong Analytical Skills</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Strong Problem-Solving Skills</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Strong Leadership Skills</label>
          </div>
        </div>
      </div>

      <!-- Accordion: Databases & Backend -->
      <div class="border rounded-lg mb-4 overflow-hidden">
        <button onclick="toggleAccordion(this)" class="w-full flex justify-between items-center px-4 py-3 bg-purple-100 text-purple-700 font-semibold">
          Databases & Backend
          <span class="text-lg">+</span>
        </button>
        <div class="accordion-content hidden px-4 pb-4 pt-2">
          <div class="flex flex-col gap-3">
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> SQL (queries, procedures, database design)</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Knowledge of SQL and NoSQL databases</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Databases</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Data Storage</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Basic knowledge of database</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Experience with REST API design</label>
            <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Knowledge of SDLC</label>
          </div>
        </div>
      </div>
      <!-- Frontend & UI -->
      <div class="border rounded-lg mb-4 overflow-hidden">
        <button onclick="toggleAccordion(this)" class="w-full flex justify-between items-center px-4 py-3 bg-purple-100 text-purple-700 font-semibold">
          Frontend & UI
          <span class="text-lg">+</span>
        </button>
        <div class="accordion-content hidden px-4 pb-4 pt-2  flex-col gap-3">
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Good knowledge of HTML CSS and JavaScript</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Good with Angular or React</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Experience with CSS preprocessors (SASS)</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Understanding of how SPAs work</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> User-Centric Thinking</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Creativity</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Basic knowledge of optimization and security best practices</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Basic knowledge of user experience and interface design</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Multimedia & Web Development</label>
        </div>
      </div>
      <!-- Cloud & DevOps -->
      <div class="border rounded-lg mb-4 overflow-hidden">
        <button onclick="toggleAccordion(this)" class="w-full flex justify-between items-center px-4 py-3 bg-purple-100 text-purple-700 font-semibold">
          Cloud & DevOps
          <span class="text-lg">+</span>
        </button>
        <div class="accordion-content hidden px-4 pb-4 pt-2  flex-col gap-3">
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Experience with AWS/Azure</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Experience with Jenkins</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Experience with Git</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Knowledge of Linux</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Able to write scripts for automation</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Knowledge of TCP/IP</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Knowledge of HTTP</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Knowledge of Docker</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Knowledge of Kubernetes</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Knowledge of DNS</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Cloud Computing</label>
        </div>
      </div>

      <!-- Security & Networking -->
      <div class="border rounded-lg mb-4 overflow-hidden">
        <button onclick="toggleAccordion(this)" class="w-full flex justify-between items-center px-4 py-3 bg-purple-100 text-purple-700 font-semibold">
          Security & Networking
          <span class="text-lg">+</span>
        </button>
        <div class="accordion-content hidden px-4 pb-4 pt-2  flex-col gap-3">
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> IT Security & Risk Management</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Knowledge of TCP/IP</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Knowledge of HTTP</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Cybersecurity</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Computer Networks</label>
        </div>
      </div>

      <!-- Testing & QA -->
      <div class="border rounded-lg mb-4 overflow-hidden">
        <button onclick="toggleAccordion(this)" class="w-full flex justify-between items-center px-4 py-3 bg-purple-100 text-purple-700 font-semibold">
          Testing & QA
          <span class="text-lg">+</span>
        </button>
        <div class="accordion-content hidden px-4 pb-4 pt-2  flex-col gap-3">
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Software Testing & Quality Assurance</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Experience with JIRA</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Experience with defect management</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Experience with Agile</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Ability to design test scenarios based on specifications</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Basic understanding of testing web and mobile applications</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Attention to Detail</label>
        </div>
      </div>

      <!-- Software Process & SDLC -->
      <div class="border rounded-lg mb-4 overflow-hidden">
        <button onclick="toggleAccordion(this)" class="w-full flex justify-between items-center px-4 py-3 bg-purple-100 text-purple-700 font-semibold">
          Software Process & SDLC
          <span class="text-lg">+</span>
        </button>
        <div class="accordion-content hidden px-4 pb-4 pt-2  flex-col gap-3">
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Familiarity with Agile methodologies</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Experience with Agile</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Project & Business Management</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Strategic Thinking</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Strategic & Organizational Management</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Knowledge of SDLC</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Ability to track key product metrics</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Understanding of product vision strategy and roadmaps</label>
        </div>
      </div>

      <!-- Architecture & System Design -->
      <div class="border rounded-lg mb-4 overflow-hidden">
        <button onclick="toggleAccordion(this)" class="w-full flex justify-between items-center px-4 py-3 bg-purple-100 text-purple-700 font-semibold">
          Architecture & System Design
          <span class="text-lg">+</span>
        </button>
        <div class="accordion-content hidden px-4 pb-4 pt-2 flex-col gap-3">
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Computer Architecture</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Computer Organization</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Gates & Components</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Logic Analysis</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Language Features</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> RTL Analysis</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> RTL Verification</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Computer Architecture Concepts</label>
          <label class="flex items-center gap-2"><input type="checkbox" class="accent-purple-700 w-4 h-4"> Theory of Computation</label>
        </div>
      </div>
      <div class="flex justify-between mt-6">
        <button class="bg-gray-200 text-gray-800 px-6 py-2 rounded-xl text-sm font-medium hover:bg-gray-300">Back</button>
        <button class="bg-purple-700 text-white px-6 py-2 rounded-xl text-sm font-medium hover:bg-purple-800">Next</button>
      </div>
      </div>
      </div>
    </div>
  </div>
 
  <!-- Accordion Toggle Script -->
    <script>
      function toggleAccordion(button) {
        const content = button.nextElementSibling;
        const icon = button.querySelector('span');
        content.classList.toggle('hidden');
        icon.textContent = content.classList.contains('hidden') ? '+' : '-';
      }
    </script>
  
  </body>
  </html>
technicalSkills.txt
18 KB