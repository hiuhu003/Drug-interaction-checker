<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personalized Info</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
      <a href="javascript:history.back()" class="text-blue-600 font-semibold flex items-center hover:underline">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L3.414 9H17a1 1 0 110 2H3.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        Back
      </a>
      <h1 class="text-blue-600 text-4xl font-bold">Personified Drug Interaction Checker</h1>
      <form method="POST" action="/logout" class="inline">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="bg-white text-blue-600 font-semibold px-4 py-2 rounded-md hover:bg-blue-500 hover:text-white transition duration-300">
          Logout
        </button>
      </form>
    </div>
        </div>
  </nav>

  <!-- Personal Medical Information Form -->
  <div class="bg-white p-8 rounded-lg shadow-xl mb-12 mt-10">
    <h3 class="text-2xl font-semibold text-blue-700 mb-6">Enter Your Personal Medical Information</h3>
    <form id="personal-info-form" action="{{ route('calculate.bmi') }}" method="POST" class="space-y-6">
      @csrf 
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label for="age" class="block text-blue-700">Age</label>
          <input type="number" id="age" name="age" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400" required>
        </div>
        <div>
          <label for="weight" class="block text-blue-700">Weight (kg)</label>
          <input type="number" id="bmi-weight" name="weight" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400" required>
        </div>
        <div>
          <label for="bmi-height" class="block text-blue-700">Height (cm)</label>
          <input type="number" id="bmi-height" name="height" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400" required>
        </div>
      </div>

      <div>
        <label for="condition" class="block text-blue-700">Medical Conditions</label>
        <input type="text" id="condition" name="condition" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400" placeholder="e.g., Hypertension, Diabetes" required>
      </div>

      <div>
        <label for="medications" class="block text-blue-700">Current Medications</label>
        <input type="text" id="medications" name="medications" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400" placeholder="List of current medications" required>
      </div>

      <button type="button" id="download-pdf-btn-1"  class="w-full bg-blue-400 text-white py-3 rounded-md mt-4 hover:bg-blue-700 transition duration-300">Submit Information</button>
   
    
       <!-- BMI Result and Health Advice -->
        @if (isset($bmi))
            <div class="mt-8 bg-gray-100 p-6 rounded-md shadow-md">
                <h1 class="text-2xl font-semibold text-blue-700 mb-4">Your BMI Result</h1>
                <p><strong>BMI:</strong> {{ $bmi }}</p>
                <p><strong>Recommendation:</strong> {{ $recommendation }}</p>
                @if ($impact)
                    <p><strong>Impact on Medical Conditions:</strong> {{ $impact }}</p>
                @endif
            </div>
        @endif
    </form>
    
    

  </div>

  <!-- Drug Interaction Check -->
  <div class="bg-white p-8 rounded-lg shadow-xl mb-12">
    <h3 class="text-2xl font-semibold text-blue-700 mb-6">Drug Interaction Check</h3>
    <form id="interaction-form" action="#" method="POST" class="space-y-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label for="drug1" class="block text-blue-700">Drug 1</label>
          <input type="text" id="drug1" name="drug1" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400" required>
        </div>
        <div>
          <label for="drug2" class="block text-blue-700">Drug 2</label>
          <input type="text" id="drug2" name="drug2" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400" required>
        </div>
      </div>

      <button type="button" id="check-interaction-btn" class="w-full bg-blue-400 text-white py-3 rounded-md mt-4 hover:bg-blue-700 transition duration-300">Check Interaction</button>
    </form>
  </div>

  <!-- Interaction Results -->
  <div id="interaction-results-section" class="bg-white p-8 rounded-lg shadow-lg hidden">
    <h3 class="text-2xl font-bold text-center text-gray-800 mb-6">Drug Interaction Details</h3>
    <div class="space-y-6">
      <div>
        <p class="text-lg font-semibold text-gray-700 mb-2">Drugs Entered:</p>
        <p class="pl-4"><strong>Drug 1:</strong> <span id="drug1-result">-</span>, <strong>Drug 2:</strong> <span id="drug2-result">-</span></p>
      </div>
      <div>
        <p class="text-lg font-semibold text-gray-700 mb-2">Possible Side Effects:</p>
        <textarea id="side-effects" class="w-full h-20 p-3 border border-gray-300 rounded-lg bg-gray-50" readonly>List of potential side effects</textarea>
      </div>
      <div>
        <p class="text-lg font-semibold text-gray-700 mb-2">Dosage Guidance:</p>
        <textarea id="dosage-guidance" class="w-full h-20 p-3 border border-gray-300 rounded-lg bg-gray-50" readonly>Recommended dosage guidance</textarea>
      </div>
      <div>
        <p class="text-lg font-semibold text-gray-700 mb-2">Quick Response if Overdosed:</p>
        <textarea id="overdose-response" class="w-full h-20 p-3 border border-gray-300 rounded-lg bg-gray-50" readonly>Immediate actions or responses if overdosed</textarea>
      </div>
      <div>
        <p class="text-lg font-semibold text-gray-700 mb-2">Risk Score:</p>
        <textarea id="risk-score" class="w-full h-20 p-3 border border-gray-300 rounded-lg bg-gray-50" readonly>Risk</textarea>
      </div>
      <div>
        <p class="text-lg font-semibold text-gray-700 mb-2">Risk level:</p>
        <textarea id="risk-level" class="w-full h-20 p-3 border border-gray-300 rounded-lg bg-gray-50" readonly>Risk level</textarea>
      </div>
      <div>
        <p class="text-lg font-semibold text-gray-700 mb-2">Personalized information:</p>
        <textarea id="personal-info" class="w-full h-20 p-3 border border-gray-300 rounded-lg bg-gray-50" readonly>How drug interaction can affect user</textarea>
      </div>
    </div>
  </div>

  <div id="loading-overlay" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
    <div class="text-center text-white p-8 bg-gray-900 rounded-md shadow-lg">
      <p class="text-xl font-semibold">Loading... Please wait</p>
      <div class="mt-4">
        <div class="w-full bg-gray-300 h-4 rounded-full">
          <div id="progress-bar" class="bg-blue-600 h-4 rounded-full" style="width: 0%;"></div>
        </div>
      </div>
    </div>
  </div>

  <form id="drug-interaction-form" class="space-y-6">
    <div class="bg-white p-8 rounded-lg shadow-xl mb-12">
      <p class="text-lg text-gray-800 mb-6">Would you like to store this drug interaction result as a PDF document for your records?</p>
      <div class="flex justify-center">
        <button type="button" id="download-pdf-btn-2" class="bg-blue-400 text-white py-2 px-6 rounded-md">Download PDF</button>
      </div>
    </div>
  </form>

  <!--footer-->
  @include('main.footer')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    

  document.getElementById("check-interaction-btn").addEventListener("click", function() {
    const drug1 = document.getElementById("drug1").value;
    const drug2 = document.getElementById("drug2").value;

    if (!drug1 || !drug2) {
      alert("Please enter both drug names.");
      return;
    }

    // Show loading screen
    document.getElementById("loading-overlay").classList.remove("hidden");
    document.getElementById("interaction-results-section").classList.add("hidden");

    let progress = 0;
    const progressBar = document.getElementById("progress-bar");
    const progressInterval = setInterval(function() {
      progress += 5;
      progressBar.style.width = `${progress}%`;
      if (progress === 100) {
        clearInterval(progressInterval);
      }
    }, 200);

    // Make the API call to the backend
    fetch("http://127.0.0.1:5000/api/check-interaction", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        drug1: drug1,
        drug2: drug2,
      }),
    })
    .then(response => response.json())
    .then(data => {
      // Hide loading and show results
      document.getElementById("loading-overlay").classList.add("hidden");
      document.getElementById("interaction-results-section").classList.remove("hidden");

      // Update the page with the data from the API response
      document.getElementById("drug1-result").textContent = data.drug1;
      document.getElementById("drug2-result").textContent = data.drug2;
      document.getElementById("side-effects").textContent = `${data.side_effects1} / ${data.side_effects2}`;
      document.getElementById("dosage-guidance").textContent = `${data.dosage1} / ${data.dosage2}`;
      document.getElementById("overdose-response").textContent = `${data.overdose_response_drug1} / ${data.overdose_response_drug2}`;
      document.getElementById("personal-info").textContent = data.personal_info;
      
      // If the backend returns a risk score, update that too
      document.getElementById("risk-score").textContent = `Risk Score: ${data.risk_score}`;
      document.getElementById("risk-level").textContent = `Risk Level: ${data.risk_level}`;
    })
    .catch(error => {
      // Handle any errors from the API call
      console.error("Error fetching data:", error);
      document.getElementById("loading-overlay").classList.add("hidden");
      alert("An error occurred while fetching the data. Please try again.");
    });
  });

  
  const { jsPDF } = window.jspdf;
  
  // Initialize jsPDF instance
  const doc = new jsPDF();
  
  // Common margin and width values
  const marginLeft = 20;
  const maxWidth = 180; // Max width for text to fit in the page (between margins)
  let yPos = 20; // Starting Y position on the page

  // Function to check if there is enough space for more text, and add a new page if necessary
  function checkPageBreak(height) {
    if (yPos + height > 270) { // 270 is a safe margin for text before a page break
      doc.addPage();
      yPos = 20; // Reset y position for the new page
    }
  }

  // Common function to generate the PDF content
  function generatePdfContent(type) {
    // Reset the yPos for each new document generation
    yPos = 20;

    if (type === "bmi") {
      // *** BMI Results Section ***
      // Title
      doc.setFontSize(18);
      doc.text("BMI Result and Health Advice", marginLeft, yPos);
      yPos += 15;

      // BMI Details
      const bmi = document.getElementById("bmi-result") ? document.getElementById("bmi-result").textContent : "Not available";
      const recommendation = document.getElementById("bmi-recommendation") ? document.getElementById("bmi-recommendation").textContent : "No recommendation available.";
      const impact = document.getElementById("bmi-impact") ? document.getElementById("bmi-impact").textContent : "No impact details available.";

      doc.setFontSize(14);
      doc.setFont("helvetica", "bold");
      doc.text("BMI Result:", marginLeft, yPos);
      yPos += 10;
      doc.setFont("helvetica", "normal");
      doc.text(`BMI: ${bmi}`, marginLeft, yPos);
      yPos += 10;

      doc.setFont("helvetica", "bold");
      doc.text("Recommendation:", marginLeft, yPos);
      yPos += 10;
      doc.setFont("helvetica", "normal");
      let recommendationLines = doc.splitTextToSize(recommendation, maxWidth);
      checkPageBreak(recommendationLines.length * 10);
      doc.text(recommendationLines, marginLeft, yPos);
      yPos += recommendationLines.length * 10 + 10;

      doc.setFont("helvetica", "bold");
      doc.text("Impact on Medical Conditions:", marginLeft, yPos);
      yPos += 10;
      doc.setFont("helvetica", "normal");
      let impactLines = doc.splitTextToSize(impact, maxWidth);
      checkPageBreak(impactLines.length * 10);
      doc.text(impactLines, marginLeft, yPos);
      yPos += impactLines.length * 10 + 10;

    } else if (type === "drugInteraction") {
      // *** Drug Interaction Report Section ***
      // Title
      doc.setFontSize(18);
      doc.text("Drug Interaction Report", marginLeft, yPos);
      yPos += 15;

      // Drug names
      const drug1 = document.getElementById("drug1-result").textContent;
      const drug2 = document.getElementById("drug2-result").textContent;
      doc.setFontSize(16);
      doc.text(`Drug 1: ${drug1}`, marginLeft, yPos);
      yPos += 10;
      doc.text(`Drug 2: ${drug2}`, marginLeft, yPos);
      yPos += 15;

      // Section - Side Effects
      const sideEffects = document.getElementById("side-effects").textContent;
      doc.setFontSize(14);
      doc.setFont("helvetica", "bold");
      doc.text("Possible Side Effects:", marginLeft, yPos);
      yPos += 10;
      doc.setFont("helvetica", "normal");
      let sideEffectLines = doc.splitTextToSize(sideEffects, maxWidth);
      checkPageBreak(sideEffectLines.length * 10);
      doc.text(sideEffectLines, marginLeft, yPos);
      yPos += sideEffectLines.length * 10 + 10;

      // Section - Dosage Guidance
      const dosageGuidance = document.getElementById("dosage-guidance").textContent;
      doc.setFontSize(14);
      doc.setFont("helvetica", "bold");
      doc.text("Dosage Guidance:", marginLeft, yPos);
      yPos += 10;
      doc.setFont("helvetica", "normal");
      let dosageLines = doc.splitTextToSize(dosageGuidance, maxWidth);
      checkPageBreak(dosageLines.length * 10);
      doc.text(dosageLines, marginLeft, yPos);
      yPos += dosageLines.length * 10 + 10;

      // Section - Overdose Response
      const overdoseResponse = document.getElementById("overdose-response").textContent;
      doc.setFontSize(14);
      doc.setFont("helvetica", "bold");
      doc.text("Quick Response if Overdosed:", marginLeft, yPos);
      yPos += 10;
      doc.setFont("helvetica", "normal");
      let overdoseLines = doc.splitTextToSize(overdoseResponse, maxWidth);
      checkPageBreak(overdoseLines.length * 10);
      doc.text(overdoseLines, marginLeft, yPos);
      yPos += overdoseLines.length * 10 + 10;

      // Section - Personalized Information
      const personalInfo = document.getElementById("personal-info").textContent;
      doc.setFontSize(14);
      doc.setFont("helvetica", "bold");
      doc.text("Personalized Information:", marginLeft, yPos);
      yPos += 10;
      doc.setFont("helvetica", "normal");
      let personalInfoLines = doc.splitTextToSize(personalInfo, maxWidth);
      checkPageBreak(personalInfoLines.length * 10);
      doc.text(personalInfoLines, marginLeft, yPos);
      yPos += personalInfoLines.length * 10 + 10;

      // Section - Risk Score and Level
      const riskScore = document.getElementById("risk-score") ? document.getElementById("risk-score").textContent : "Not available";
      const riskLevel = document.getElementById("risk-level") ? document.getElementById("risk-level").textContent : "Not available";
      doc.setFontSize(14);
      doc.setFont("helvetica", "bold");
      doc.text(`Risk Score: ${riskScore}`, marginLeft, yPos);
      yPos += 10;
      doc.text(`Risk Level: ${riskLevel}`, marginLeft, yPos);
    }

    // Save the PDF
    doc.save("BMI_and_Drug_Interaction_Report.pdf");
  }

  // Add event listeners to both buttons
  document.getElementById("download-pdf-btn-1").addEventListener("click", function () {
    generatePdfContent("bmi");
  });

  document.getElementById("download-pdf-btn-2").addEventListener("click", function () {
    generatePdfContent("drugInteraction");
  });



</script>

</body>
</html>
