<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalInfo;
use Illuminate\Support\Facades\Log;

class PersonalInfoController extends Controller
{
    public function calculateBMI(Request $request)
    {
        // Validate input
        $request->validate([
            'age' => 'required|integer|min:1',
            'weight' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1',
            'medical_conditions' => 'nullable|string',
            'medications' => 'nullable|string',
        ]);
    }
     public function processMedicalInfo(Request $request)
    {
        $weight = $request->input('weight');
        $height = $request->input('height') / 100; 

       
        
            // Validate the inputs
        if (!$weight || !$height || $height <= 0) {
            return back()->withErrors(['error' => 'Invalid weight or height input.']);
        }

        $bmi = $weight / ($height * $height);

        $bmi = round($bmi, 2);

        // BMI Category and Recommendations
        $recommendation = '';
        if ($bmi < 18.5) {
            $recommendation = 'Underweight: Increase nutrient intake with calorie-dense foods.';
        } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
            $recommendation = 'Normal weight: Maintain current lifestyle and diet.';
        } elseif ($bmi >= 25 && $bmi <= 29.9) {
            $recommendation = 'Overweight: Adopt a balanced diet and increase physical activity.';
        } else {
            $recommendation = 'Obesity: Consult a healthcare provider for weight management.';
        }

      // Impact on Medical Conditions
$medical_conditions = strtolower($request->input('medical_conditions'));
$impact = '';

if (str_contains($medical_conditions, 'hypertension')) {
    $impact .= 'High BMI can increase blood pressure, exacerbating hypertension. Adopt a low-sodium, DASH diet and engage in regular cardiovascular exercise. ';
}

if (str_contains($medical_conditions, 'diabetes')) {
    $impact .= 'Being overweight or obese can worsen blood sugar control, increasing the risk of diabetes complications. Focus on a low-glycemic diet and consistent weight management strategies. ';
}

if (str_contains($medical_conditions, 'heart disease') || str_contains($medical_conditions, 'cardiovascular disease')) {
    $impact .= 'Obesity is a significant risk factor for heart disease. Weight reduction can lower cholesterol levels, reduce strain on the heart, and improve circulation. ';
}

if (str_contains($medical_conditions, 'cancer')) {
    $impact .= 'Excess body fat has been linked to a higher risk of certain cancers (e.g., breast, colon). Maintaining a healthy weight may reduce cancer risk and improve overall prognosis. ';
}

if (str_contains($medical_conditions, 'arthritis')) {
    $impact .= 'Extra body weight increases pressure on joints, worsening arthritis symptoms. Losing weight can reduce joint pain and improve mobility. ';
}

if (str_contains($medical_conditions, 'asthma') || str_contains($medical_conditions, 'respiratory issues')) {
    $impact .= 'Excess weight can impair lung function and worsen respiratory conditions like asthma. Weight loss can improve breathing and reduce severity. ';
}

if (str_contains($medical_conditions, 'stroke')) {
    $impact .= 'High BMI increases the risk of stroke by raising blood pressure and cholesterol levels. Weight management is crucial for prevention. ';
}

if (str_contains($medical_conditions, 'kidney disease')) {
    $impact .= 'Obesity can increase the progression of kidney disease by raising blood pressure and causing diabetes complications. A healthy diet and exercise are recommended. ';
}

if (str_contains($medical_conditions, 'liver disease') || str_contains($medical_conditions, 'fatty liver')) {
    $impact .= 'Obesity is a leading cause of non-alcoholic fatty liver disease (NAFLD). Weight loss can reduce fat buildup in the liver and improve liver function. ';
}

if (str_contains($medical_conditions, 'depression') || str_contains($medical_conditions, 'mental health')) {
    $impact .= 'Obesity can negatively impact mental health, contributing to conditions like depression. Regular exercise and weight management may improve mood and self-esteem. ';
}

// Default message if no recognized condition is detected
if (empty($impact)) {
    $impact = 'No specific impact detected based on the conditions provided. Maintaining a healthy BMI is beneficial for overall health.';
}


        // Return the results
        return view('final.info', compact('bmi', 'recommendation', 'impact'));
    }
}
