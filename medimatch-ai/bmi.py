from flask import Flask, request, jsonify # type: ignore
import requests # type: ignore

app = Flask(__name__)

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

# Route to get FDA information for medical conditions
@app.route('/api/get-condition-info', methods=['GET'])
def get_condition_info():
    condition = request.args.get('condition', '')
    if condition:
        info = get_fda_condition_info(condition)
        return jsonify({"info": info})
    return jsonify({"info": "Please provide a valid condition."}), 400

if __name__ == '__main__':
    app.run(debug=True)
