from flask import Flask, request, jsonify  # type: ignore
import requests  # type: ignore
import torch  # type: ignore
import re
import torch.nn as nn  # type: ignore
import torch.optim as optim  # type: ignore
from flask_cors import CORS  # type: ignore

app = Flask(__name__)

# Enable CORS for all routes
CORS(app, resources={r"/api/*": {"origins": "http://127.0.0.1:8000"}})

# Dummy model for demonstration (replace with your actual trained model)
class InteractionModel(nn.Module):
    def __init__(self):
        super(InteractionModel, self).__init__()
        # Assuming the original model had 3 layers: fc1, fc2, and fc3
        self.fc1 = nn.Linear(3, 128)  # From input size 3 to 128
        self.fc2 = nn.Linear(128, 64)  # From 128 to 64
        self.fc3 = nn.Linear(64, 1)    # From 64 to output size 1

    def forward(self, x):
        x = torch.relu(self.fc1(x))
        x = torch.relu(self.fc2(x))
        x = torch.sigmoid(self.fc3(x))  # Applying sigmoid on the output
        return x

# Load the checkpoint with the 'strict' flag set to False to ignore unexpected keys
model = InteractionModel()  # Use your current model definition

# Load the weights and ignore errors for mismatched keys
checkpoint = torch.load('model.pth', weights_only=True)
model.load_state_dict(checkpoint, strict=False)

# Function to get FDA data for a specific condition
def get_fda_condition_info(condition):
    try:
        # URL for querying FDA's database (e.g., adverse events, treatment options, etc.)
        FDA_API_URL = "https://api.fda.gov/drug/event.json"
        
        # Parameters to search based on the condition (simplified here)
        params = {'search': f'patient.drug.openfda.substance_name:"{condition}"', 'limit': 1}
        response = requests.get(FDA_API_URL, params=params)

        if response.status_code == 200:
            data = response.json()
            if 'results' in data and len(data['results']) > 0:
                # You could format or filter the data further as needed
                info = data['results'][0].get('serious_adverse_event', 'No significant adverse events reported.')
                return info
        return "No specific FDA data found for this condition."
    except Exception as e:
        print(f"Error fetching FDA data for condition {condition}: {e}")
        return "Error retrieving information."

# Function to get FDA data (side effects, dosage guidance, and overdose information)
def get_fda_data(drug_name):
    try:
        FDA_API_URL = "https://api.fda.gov/drug/label.json"
        params = {'search': f'openfda.brand_name:"{drug_name}"', 'limit': 1}
        response = requests.get(FDA_API_URL, params=params)

        if response.status_code == 200:
            data = response.json()
            print(f"FDA data for {drug_name}: {data}")  # Debug print statement
            if 'results' in data and len(data['results']) > 0:
                return data['results'][0]
        return None
    except Exception as e:
        print(f"Error fetching FDA data for {drug_name}: {e}")
        return None

def predict_interaction(side_effects1, side_effects2, dosage1, dosage2):
    try:
        # Process features for the model
        side_effects_combined = (len(side_effects1.split()) + len(side_effects2.split())) / 2
        dosage_combined = (len(dosage1.split()) + len(dosage2.split())) / 2

        # Add flags for critical side effects as features (1 if present, 0 otherwise)
        critical_side_effects_flag = int("bleeding" in side_effects1 or "bleeding" in side_effects2)
        
        overdose_risk = 0.5  # Placeholder value; adjust as needed

        # Create a tensor of features
        features = torch.tensor([[side_effects_combined, dosage_combined, critical_side_effects_flag, overdose_risk]], dtype=torch.float32)

        # Make prediction
        with torch.no_grad():
            risk_score = model(features).item()
        
        # Classify based on threshold
        risk_level = "High Risk" if risk_score > 0.5 else "Low Risk"
        return {"risk_score": risk_score, "risk_level": risk_level}
    except Exception as e:
        print(f"Error predicting interaction: {e}")
        return {"error": str(e)}

# Function to summarize the side effects based on FDA data (limit to 200 words)
def summarize_side_effects(fda_side_effects):
    """Summarize side effects from FDA data with a word limit of 200."""
    if not fda_side_effects:
        return "No major side effects listed."
    
    # Ensure fda_side_effects is a string, even if it's a list
    if isinstance(fda_side_effects, list):
        fda_side_effects = " ".join(fda_side_effects)  # Join list elements into a single string

    # Split the string into words
    words = fda_side_effects.split()

    # Pick the first 200 words (or fewer if there aren't that many)
    limited_words = words[:200]

    # Join the words back into a string
    limited_text = " ".join(limited_words)

    return limited_text

# Function to summarize the dosage based on FDA data
def summarize_dosage(fda_dosage_info):
    """Summarize dosage based on FDA data with a word limit of 200."""
    if not fda_dosage_info:
        return "No dosage guidance available."
    
    # Ensure fda_dosage_info is a string, even if it's a list
    if isinstance(fda_dosage_info, list):
        fda_dosage_info = " ".join(fda_dosage_info)  # Join list elements into a single string

    # Split the string into words
    words = fda_dosage_info.split()

    # Pick the first 200 words (or fewer if there aren't that many)
    limited_words = words[:200]

    # Join the words back into a string
    limited_text = " ".join(limited_words)

    return limited_text

# Function to summarize overdose response based on FDA data
def summarize_overdose(fda_overdose_info):
    """Summarize overdose response based on FDA data with a word limit of 200."""
    if not fda_overdose_info:
        return "Overdose information is not available."
    
    # Ensure fda_overdose_info is a string, even if it's a list
    if isinstance(fda_overdose_info, list):
        fda_overdose_info = " ".join(fda_overdose_info)  # Join list elements into a single string

    # Split the string into words
    words = fda_overdose_info.split()

    # Pick the first 200 words (or fewer if there aren't that many)
    limited_words = words[:200]

    # Join the words back into a string
    summary = " ".join(limited_words)

    return summary

# Route to get FDA information for medical conditions
@app.route('/api/get-condition-info', methods=['GET'])
def get_condition_info():
    condition = request.args.get('condition', '')
    if condition:
        info = get_fda_condition_info(condition)
        return jsonify({"info": info})
    return jsonify({"info": "Please provide a valid condition."}), 400

# Route to check drug interaction
@app.route('/api/check-interaction', methods=['POST'])
def check_interaction():
    data = request.json
    drug1 = data.get("drug1")
    drug2 = data.get("drug2")

    if not drug1 or not drug2:
        return jsonify({"error": "Please provide both drug names."}), 400

    # Get FDA data for both drugs
    fda_data1 = get_fda_data(drug1)
    fda_data2 = get_fda_data(drug2)

    if not fda_data1 or not fda_data2:
        return jsonify({"error": "FDA data not found for one or both drugs."}), 404

    # Extract side effects and dosage guidance (with fallback)
    side_effects1 = fda_data1.get('adverse_reactions', ['No side effects listed.'])[0]
    side_effects2 = fda_data2.get('adverse_reactions', ['No side effects listed.'])[0]
    dosage1 = fda_data1.get('dosage_and_administration', ['No dosage guidance available.'])[0]
    dosage2 = fda_data2.get('dosage_and_administration', ['No dosage guidance available.'])[0]

    # Extract overdose response if available
    overdose_response1 = fda_data1.get('overdosage', 'Overdose response information not available')
    overdose_response2 = fda_data2.get('overdosage', 'Overdose response information not available')

    # Summarize data based on FDA information
    summarized_side_effects1 = summarize_side_effects(side_effects1)  # Remove join as it's already a string
    summarized_side_effects2 = summarize_side_effects(side_effects2)
    summarized_dosage1 = summarize_dosage(dosage1)  # Remove join as it's already a string
    summarized_dosage2 = summarize_dosage(dosage2)
    summarized_overdose_response1 = summarize_overdose(overdose_response1)  # Use overdose_response1 correctly
    summarized_overdose_response2 = summarize_overdose(overdose_response2)

    # Print summarized data for debugging
    print(f"Summarized Side effects for {drug1}: {summarized_side_effects1}")
    print(f"Summarized Side effects for {drug2}: {summarized_side_effects2}")
    print(f"Summarized Dosage for {drug1}: {summarized_dosage1}")
    print(f"Summarized Dosage for {drug2}: {summarized_dosage2}")
    print(f"Summarized Overdose response for {drug1}: {summarized_overdose_response1}")
    print(f"Summarized Overdose response for {drug2}: {summarized_overdose_response2}")

    # Predict the interaction
    prediction_result = predict_interaction(summarized_side_effects1, summarized_side_effects2, summarized_dosage1, summarized_dosage2)

    # Return the result as JSON
    return jsonify({
        "drug1": drug1,
        "drug2": drug2,
        "side_effects1": summarized_side_effects1,
        "side_effects2": summarized_side_effects2,
        "dosage1": summarized_dosage1,
        "dosage2": summarized_dosage2,
        "overdose_response_drug1": summarized_overdose_response1,
        "overdose_response_drug2": summarized_overdose_response2,
        "risk_score": prediction_result.get("risk_score"),
        "risk_level": prediction_result.get("risk_level"),
        "personal_info": "No personalized information provided"
    })

if __name__ == '__main__':
    app.run(debug=True)
