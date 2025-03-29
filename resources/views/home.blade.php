<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Track - Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    <script>
        function toggleDropdown() {
            document.getElementById("trackDropdown").classList.toggle("hidden");
        }

        window.onclick = function(event) {
            if (!event.target.closest('.dropdown')) {
                const dropdown = document.getElementById("trackDropdown");
                if (dropdown && !dropdown.classList.contains("hidden")) {
                    dropdown.classList.add("hidden");
                }
            }
        }
    </script>
</head>
<body class="bg-black text-white">

    <!-- Navbar -->
    <nav class="flex justify-between items-center px-10 py-6 absolute w-full z-10 bg-transparent">
        <div class="text-2xl font-bold">TrainTrack</div>
        <div class="space-x-6 flex items-center relative">
            <a href="/" class="text-gray-300 hover:text-white">Home</a>

            <!-- Clickable Dropdown -->
            <div class="relative dropdown">
                <button onclick="toggleDropdown()" class="text-gray-300 hover:text-white focus:outline-none flex items-center space-x-1">
                    <span>Track</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Content -->
                <div id="trackDropdown" class="absolute left-0 mt-2 w-64 bg-white text-black shadow-lg rounded-lg z-20 hidden border">
                    <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                        <span>CV Preparation</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                        <span>LinkedIn Optimization</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                        <span>Tutorials</span>
                    </a>
                </div>
            </div>

            <a href="#" class="text-gray-300 hover:text-white">About Us</a>
            <a href="#" class="text-gray-300 hover:text-white">Contact Us</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative w-full h-screen flex items-end justify-start p-10 bg-cover bg-center" 
        style="background-image: url('{{ asset('Background.jpg') }}');">
        <div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-30"></div>
        <div class="relative z-10 text-left">
            <h2 class="text-6xl font-bold leading-tight">The Fast Track<br> to Your Perfect Internship</h2>
            <p class="mt-4 text-lg text-gray-300">On the right track to your perfect internship – smart matching for career success.</p>
            <a href="{{ route('traintrack.start') }}" class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-lg">
                Try TrainTrack Now
            </a>
        </div>
    </section>

</body>
</html>
