<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediMatch</title>
    <!-- Tailwind CSS (v2.2.19) CDN -->
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    <style>
        /* Custom CSS for a smooth fade-out effect */
        .fade-out {
            animation: fadeOut 2s ease-in forwards;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
                visibility: hidden;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-b from-blue-900 to-blue-700 font-sans text-white">

    <!-- Splash Screen -->
    <div id="splash-screen" class="fixed inset-0 flex items-center justify-center bg-[#002F5D] z-50">
        <img src="logo.png" alt="Logo" id="logo" class="w-[200px] md:w-[250px] animate-bounce transition-all ease-in-out duration-500">
    </div>


    <script src="splash.js"></script>
</body>
</html>
