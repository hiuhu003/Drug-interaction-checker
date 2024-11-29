 <!-- Navbar -->
 <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

                 <!-- Back Button -->
                <a href="javascript:history.back()" class="text-black font-semibold flex items-center hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                    Back
                </a>

                <!-- Logo Section -->
                <div class="flex justify-center items-center">
                    <a href="#" class="text-3xl font-bold text-blue-500">MediMatch </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-8 items-center">
                    <!-- Services Dropdown -->
                    <div class="relative group" id="services-dropdown">
                        <button class="text-gray-700 hover:text-blue-500 font-semibold focus:outline-none">
                            Services
                        </button>
                        <!--Dropdown Menu -->
                        <div id="dropdown-menu" class="absolute left-0 mt-2 w-48 bg-white border rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 hidden group-hover:block">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Drug Interaction Checker</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Health Personalization</a>
                        </div>
                    </div>
                    <!-- Contact Link -->
                    <a href="#" class="text-gray-700 hover:text-blue-500 font-semibold">Contact</a>

                    <!-- FAQ'S -->
                    <a href="{{ route('faq') }}" class="text-gray-700 hover:text-blue-500 font-semibold">FAQ'S</a>

                    <!-- Review Link -->
                    <a href="#review" class="text-gray-700 hover:text-blue-500 font-semibold">Review</a>
            

                  

                    <!-- Logout Button -->
                    <form method="POST" action="/logout" class="inline">
                    <!-- Replace with Laravel's CSRF token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="bg-white text-black font-semibold px-4 py-2 rounded-md hover:bg-blue-500 hover:text-white transition duration-300">
                        Logout
                    </button>

</div>
                    </form>
                <!-- Mobile Menu Button -->
                <div class="flex md:hidden items-center">
                    <button id="menu-button" class="text-gray-700 hover:text-blue-500 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg border-t">
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Services</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-100 ml-4">Drug Interaction Checker</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-100 ml-4">Health Personalization</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Contact</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Review</a>
        </div>
    </nav>

    <script>
        // Mobile menu toggle
        const menuButton = document.getElementById('menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        //dropdown menu
        const servicesBtn = document.getElementById('services-btn');
         const dropdownMenu = document.getElementById('dropdown-menu');

         //visiblity of menu
         servicesBtn.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
         });

        menuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Close the dropdown if clicked outside
        document.addEventListener('click', (event) => {
        if (!document.getElementById('services-dropdown').contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
         });
    </script>