<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\DrugInteraction;

class DrugInteractionController extends Controller
{
    public function checkInteraction(Request $request)
    {
        $drug1 = $request->input('drug1');
        $drug2 = $request->input('drug2');

        // Call the Python script or API that uses PyTorch
        $response = Http::post('http://localhost:5000/check', [
            'drug1' => $drug1,
            'drug2' => $drug2,
        ]);

        return response()->json($response->json());
    }

    public function store(Request $request){
        $validated = $request->validate([
            'drug1' => 'required|string|max:255',
            'drug2' => 'required|string|max:255',
            'side_effects' => 'nullable|string',
            'dosage_guidance' => 'nullable|string',
            'overdose_response' => 'nullable|string',
        ]);
        DrugInteraction::create($validated);

        return response()->json(['message' => 'Drug interaction data saved successfully']);
    }

    // Fetch drug interaction data
    public function index()
    {
        $interactions = DrugInteraction::all();
        return response()->json($interactions);
    }
}
