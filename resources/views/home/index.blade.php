<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediMatch</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@include('home.splash')
<body class="bg-gray-50 font-sans leading-relaxed text-gray-800">

<nav class="fixed top-0 left-0 w-full bg-white shadow-lg z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo Section -->
        <div class="text-2xl font-bold text-blue-600">
            MediMatch
        </div>

        <!-- Desktop Menu (Hidden on small screens) -->
        <div class="hidden lg:flex space-x-8">
            <a href="#about" class="text-lg text-blue-600 hover:text-blue-800 transition duration-300">About</a>
            <a href="#services" class="text-lg text-blue-600 hover:text-blue-800 transition duration-300">Services</a>
            <a href="#reviews" class="text-lg text-blue-600 hover:text-blue-800 transition duration-300">Reviews</a>

            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-300"
                        >
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-300">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-300">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>

        <!-- Mobile Menu Button (Visible on small screens) -->
        <div class="lg:hidden">
            <button class="text-blue-600 focus:outline-none" id="menu-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="lg:hidden bg-white shadow-md absolute w-full top-16 left-0 hidden">
        <div class="flex flex-col items-center space-y-4 py-4">
            <a href="#about" class="text-lg text-blue-600 hover:text-blue-800 transition duration-300">About</a>
            <a href="#services" class="text-lg text-blue-600 hover:text-blue-800 transition duration-300">Services</a>
            <a href="#reviews" class="text-lg text-blue-600 hover:text-blue-800 transition duration-300">Reviews</a>

            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-300"
                        >
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-300">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-300">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </div>
</nav>





    <!-- Hero Section -->
    <section class="relative bg-blue-700 text-white text-center py-32">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-700 via-blue-500 to-blue-400 opacity-60"></div>
        <div class="relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">AI-Driven Drug Interaction Checker</h1>
            <p class="text-lg md:text-xl mb-8">Ensuring Safe Medication Management for a Healthier Tomorrow</p>
            <a href="{{ route('login') }}" class="bg-indigo-600 px-8 py-3 text-white rounded-full shadow-lg hover:bg-indigo-500 transition">Get Started</a>
        </div>
    </section>
<!-- About MediMatch Section -->
<section id="about" class="py-20 px-6 lg:px-20 bg-gray-50">
    <!-- Heading -->
    <h2 class="text-3xl lg:text-4xl font-semibold text-indigo-600 text-center mb-8">About MediMatch</h2>
    
    <!-- Paragraph 1: Introduction -->
    <div class="max-w-4xl mx-auto text-center mb-12">
        <p class="text-lg text-gray-700 leading-relaxed">
            Welcome to MediMatch, your trusted AI-driven solution for managing and improving your health. At MediMatch, we understand how complex it can be to keep track of the medications you're taking, and how vital it is to make sure that everything works in harmony. Our platform provides an easy-to-use tool that scans through an extensive medical database to check if your medications are safe to take together, helping you avoid potentially dangerous drug interactions.
        </p>
    </div>

    <!-- Paragraph 2: How It Works (Initially hidden) -->
    <div id="para-2" class="max-w-3xl mx-auto text-center mb-12 hidden">
        <p class="text-lg text-gray-700 leading-relaxed">
            With just a few simple inputs, MediMatch instantly scans a comprehensive database, cross-referencing your medications to provide you with clear, actionable insights. You can quickly see whether two or more drugs interact, and if they do, you’ll be notified of any harmful effects or warnings associated with their combination.
        </p>
    </div>
    <button id="read-more-2" class="text-blue-500 mt-4">Read More</button>

    <!-- Paragraph 3: Why Choose MediMatch (Initially hidden) -->
    <div id="para-3" class="max-w-3xl mx-auto text-center mb-12 hidden">
        <p class="text-lg text-gray-700 leading-relaxed">
            Choosing the right medications and understanding their interactions is crucial for your well-being. MediMatch simplifies this complex task by providing you with immediate, evidence-based feedback. Whether you’re managing chronic conditions, recovering from surgery, or simply taking over-the-counter medications, our service ensures that your health is in safe hands.
        </p>
    </div>
    <button id="read-more-3" class="text-blue-500 mt-4">Read More</button>

    <!-- Conclusion (Initially hidden) -->
    <div id="para-4" class="max-w-3xl mx-auto text-center mb-12 hidden">
        <p class="text-lg text-gray-700 leading-relaxed">
            At MediMatch, we’re committed to helping you stay safe and informed when it comes to managing your health. With the support of our advanced AI and a user-friendly interface, you can feel confident in the choices you make regarding your medication. Your health matters—let us help you protect it.
        </p>
    </div>
    <button id="read-more-4" class="text-blue-500 mt-4">Read More</button>

</section>


    <!-- Services Section -->
    <section id="services" class="bg-white py-20">
        <h2 class="text-3xl font-semibold text-center text-indigo-600 mb-12">Our Services</h2>
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12 px-6">
            <!-- Service Card 1 -->
            <div class="bg-white shadow-lg rounded-lg p-6 transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                <h3 class="text-xl font-semibold text-indigo-600 mb-4">Medication Compatibility Check</h3>
                <p class="text-gray-700">Check the compatibility of two or more medications to avoid harmful interactions. Our AI-driven system helps you make informed choices about your health.</p>
            </div>
            <!-- Service Card 2 -->
            <div class="bg-white shadow-lg rounded-lg p-6 transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                <h3 class="text-xl font-semibold text-indigo-600 mb-4">Dosage Adjustment Guidance</h3>
                <p class="text-gray-700">Get personalized recommendations for dosage adjustments based on your medical history, ensuring optimal medication effectiveness while minimizing risks.</p>
            </div>
            <!-- Service Card 3 -->
            <div class="bg-white shadow-lg rounded-lg p-6 transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                <h3 class="text-xl font-semibold text-indigo-600 mb-4">Side Effect Analysis</h3>
                <p class="text-gray-700">Understand potential side effects when combining certain medications. Our AI analyzes possible risks to help you make safer choices.</p>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section id="reviews" class="py-20 px-6 lg:px-20 bg-gray-100">
       @include('home.reviews')
    </section>

    <!-- Footer -->
    <footer class="bg-indigo-600 text-white py-12">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-lg">© 2024 MediMatch. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        // Toggle mobile menu visibility
        document.getElementById('menu-toggle').addEventListener('click', () => {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Function to handle "Read More" click event
    function toggleText(paragraphId, buttonId) {
        const paragraph = document.getElementById(paragraphId);
        const button = document.getElementById(buttonId);

        // Toggle visibility of the paragraph
        paragraph.classList.toggle('hidden');

        // Change button text between "Read More" and "Read Less"
        if (paragraph.classList.contains('hidden')) {
            button.textContent = 'Read More';
        } else {
            button.textContent = 'Read Less';
        }
    }

    // Add event listeners to "Read More" buttons
    document.getElementById('read-more-2').addEventListener('click', function() {
        toggleText('para-2', 'read-more-2');
    });

    document.getElementById('read-more-3').addEventListener('click', function() {
        toggleText('para-3', 'read-more-3');
    });

    document.getElementById('read-more-4').addEventListener('click', function() {
        toggleText('para-4', 'read-more-4');
    });

    </script>

</body>

</html>
