

<!-- Drug Interaction Check -->
<div class="bg-white p-8 rounded-lg shadow-xl mb-12 mt-10" >
  <h3 class="text-2xl font-semibold text-blue-700 mb-6">Drug Interaction Check</h3>
  <form id="interaction-form" action="/drug-interactions" method="POST" class="space-y-6">
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

    <button type="button" id="check-interaction-btn" class="w-full bg-blue-600 text-white py-3 rounded-md mt-4 hover:bg-blue-700 transition duration-300">Check Interaction</button>
  </form>
</div>

<!-- Interaction Results -->
<div> 
  <table class="min-w-full table-auto border-collapse text-left">
    <tbody id="interaction-results" class="text-gray-800">
    <div id="interaction-results-section" class="bg-white p-8 rounded-lg shadow-lg hidden">
  <h3 class="text-2xl font-bold text-center text-gray-800 mb-6">Drug Interaction Details</h3>
  
  <div class="space-y-6">
    <!-- Drugs Entered -->
    <div>
      <p class="text-lg font-semibold text-gray-700 mb-2">Drugs Entered:</p>
      <p class="pl-4"><strong> Drug 1:</strong> <span id="drug1-result">-</span>, <strong>Drug 2:</strong> <span id="drug2-result">-</span></p>
    </div>

    <!-- Possible Side Effects -->
    <div>
      <p class="text-lg font-semibold text-gray-700 mb-2">Possible Side Effects:</p>
      <textarea id="side-effects" class="w-full h-20 p-3 border border-gray-300 rounded-lg bg-gray-50" readonly>List of potential side effects</textarea>
    </div>

    <!-- Dosage Guidance -->
    <div>
      <p class="text-lg font-semibold text-gray-700 mb-2">Dosage Guidance:</p>
      <textarea id="dosage-guidance" class="w-full h-20 p-3 border border-gray-300 rounded-lg bg-gray-50" readonly>Recommended dosage guidance</textarea>
    </div>

    <!-- Quick Response if Overdosed -->
    <div>
      <p class="text-lg font-semibold text-gray-700 mb-2">Quick Response if Overdosed:</p>
      <textarea id="overdose-response" class="w-full h-20 p-3 border border-gray-300 rounded-lg bg-gray-50" readonly>Immediate actions or responses if overdosed</textarea>
    </div>
  </div>
</div>

    </tbody>
  </table>
</div>

<!-- Loading Overlay (Initially Hidden) -->
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

  document.getElementById("download-pdf-btn").addEventListener("click", function() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Set font styles and sizes
    doc.setFont("helvetica", "normal");
    doc.setFontSize(16);

    let yPos = 20; // Starting Y position on the page
    const marginLeft = 20;
    const marginRight = 20;
    const maxWidth = 180; // Max width for text to fit in page (between margins)

    // Function to check if there is enough space on the page for the next block of text
    function checkPageBreak(height) {
      if (yPos + height > 270) {  // 270 is a safe margin for text before a page break
        doc.addPage();
        yPos = 20;  // Reset y position for the new page
      }
    }

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
    checkPageBreak(sideEffectLines.length * 10); // Check if there is enough space
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
    checkPageBreak(dosageLines.length * 10); // Check if there is enough space
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
    checkPageBreak(overdoseLines.length * 10); // Check if there is enough space
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
    checkPageBreak(personalInfoLines.length * 10); // Check if there is enough space
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

    // Save the PDF
    doc.save(`${drug1}_vs_${drug2}_interaction_report.pdf`);

    
  });
</script>

