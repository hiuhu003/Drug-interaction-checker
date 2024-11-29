<nav id="desktop-nav"> 
    <div class="container">
        <div class="logo"> MediMatch</div><br>
        <div class="img"><img src="logo.png" alt=""></div>
    </div>
        <div>
            <ul class="nav-links">
                <li><a href="#about">About</a></li>
                <li><a href="#Services">Services</a></li>
                <li><a href="#Contact"> Contact</a></li>
                <li><a href="#Review"> Review</a></li>

                @if (Route::has('login'))
                            
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        <button id="btn-container" class="btn">Login</button>
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                        <button id="btn-container" class="btn">Register</button>
                                        </a>
                                    @endif
                                @endauth
                            
                        @endif
            </ul>
        </div>
    </nav>
    <nav id="hamburger-nav">
        <div class="logo">MediMatch</div>
        <div class="hamburger-menu">
            <div class="hamburger-icon" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="menu-links">
                <li><a href="#About" onclick="toggleMenu()">About</a></li>
                <li><a href="#Services" onclick="toggleMenu()">Services</a></li>
                <li><a href="#Contact" onclick="toggleMenu()">Contact</a></li>
                <li><a href="#Review" onclick="toggleMenu()"> Review</a></li>
            </div>
        </div>
    </nav>