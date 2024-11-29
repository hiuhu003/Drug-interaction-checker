<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediMatch/Drug interaction</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

   @include('main.navbar')

    <!--Input section -->

   @include('main.input')

   

</div>
   <!--personalisation link-->
   
<br>
<div class="w-full p-4 bg-white shadow-md">
   <h2 class="text-2xl font-extrabold text-gray-800 mb-2 text-center">
      Get Personalized Insights!
   </h2>
   <p class="text-gray-600 mb-4 text-center">
      Tailored solutions that consider your unique needs. Click the button to explore.
   </p>
   <div class="flex justify-center">
      <button 
         type="button" 
         class="w-full max-w-md px-6 py-3 bg-blue-500 text-white text-lg font-semibold 
         rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-400 
         focus:ring-opacity-50 transition duration-200 transform hover:scale-105 active:scale-95"
         onclick="window.location.href='/info'">
         Explore Now
      </button>
   </div>
</div>


   <!--Review Section-->
   @include('main.review_form')
 
   <!--footer Section-->
   @include('main.footer')
</body>
</html>
