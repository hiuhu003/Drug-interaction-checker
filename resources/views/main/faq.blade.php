<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>FAQ'S </title>
</head>
<body>
<div class="bg-gray-50 min-h-screen py-10">

        <!-- Back Arrow -->
        <div class="mb-6">
            <button onclick="history.back()" class="flex items-center text-blue-600 hover:text-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </button>
        </div>
    <div class="container mx-auto px-6">
        <!-- Page Heading -->
        <h1 class="text-4xl font-bold text-blue-600 text-center mb-6">MediMatch FAQs</h1>
        <p class="text-lg text-gray-600 text-center mb-10">
            Find answers to your most pressing questions about drug interactions, side effects, and usage.
            MediMatch helps you make informed decisions about your health.
        </p>

        <!-- FAQ Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- FAQ Item 1 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-blue-500 mb-2">1. What is a drug interaction?</h2>
                <p class="text-gray-600">
                    A drug interaction occurs when one medication affects how another works, potentially increasing side effects or altering effectiveness. 
                    MediMatch helps you identify and avoid harmful interactions by checking combinations of drugs you input.
                </p>
            </div>

            <!-- FAQ Item 2 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-blue-500 mb-2">2. How does MediMatch work?</h2>
                <p class="text-gray-600">
                    MediMatch allows you to input the exact name of a medication. It then checks the drug’s interactions, side effects, and warnings against others in its comprehensive database.
                    Be sure to input the correct and complete name of the drug for accurate results.
                </p>
            </div>

            <!-- FAQ Item 3 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-blue-500 mb-2">3. How accurate is MediMatch?</h2>
                <p class="text-gray-600">
                    MediMatch uses a robust database and AI that includes information on thousands of drugs, ensuring that it provides highly accurate interaction and side effect data. 
                    However, always consult with your healthcare provider for personalized advice.
                </p>
            </div>

            <!-- FAQ Item 4 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-blue-500 mb-2">4. Is MediMatch free to use?</h2>
                <p class="text-gray-600">
                    Yes! MediMatch is completely free to use. You can check drug interactions and side effects at no cost, without needing to sign up or provide any personal information.
                </p>
            </div>

            <!-- FAQ Item 5 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-blue-500 mb-2">5. Can I check over-the-counter (OTC) drugs?</h2>
                <p class="text-gray-600">
                    Yes, MediMatch includes OTC drugs in its database. You can check for potential interactions with prescription or non-prescription medications.
                </p>
            </div>

            <!-- FAQ Item 6 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-blue-500 mb-2">6. What should I do if I find a serious interaction?</h2>
                <p class="text-gray-600">
                    If you discover a serious drug interaction using MediMatch, contact your doctor or pharmacist immediately. Do not stop taking medication without professional guidance.
                </p>
            </div>

            <!-- FAQ Item 7 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-blue-500 mb-2">7. Can I use MediMatch for herbal supplements?</h2>
                <p class="text-gray-600">
                    Yes, MediMatch includes common herbal supplements in its database. You can check for potential interactions with prescription or OTC drugs.
                </p>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="text-center mt-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Still have questions?</h2>
            <p class="text-gray-600 mb-6">
                If your question isn’t listed here, feel free to contact our support team for assistance.
            </p>
            <a href="/contact" class="bg-blue-500 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-600">
                Contact Us
            </a>
        </div>
    </div>
</div>



</body>
</html>