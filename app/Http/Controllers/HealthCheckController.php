<?php

namespace App\Http\Controllers;

use App\Models\HealthCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HealthCheckController extends Controller
{
    public function index()
    {
        return view('health-check.index');
    }

    public function create()
    {
        return view('health-check.form');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|in:male,female',
            'height' => 'required|numeric|min:50|max:300',
            'weight' => 'required|numeric|min:20|max:500',
            'symptoms' => 'nullable|array',
            'stress_level' => 'required|integer|min:1|max:10',
            'sleep_hours' => 'required|integer|min:1|max:24',
            'exercise_frequency' => 'required|in:never,rarely,sometimes,often,daily',
            'smoking_status' => 'required|in:never,former,current',
            'alcohol_consumption' => 'required|in:never,rarely,moderate,heavy',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $healthCheck = new HealthCheck();
        $healthCheck->fill($request->all());
        
        // Calculate BMI
        $healthCheck->calculateBMI();
        
        // Calculate risk level
        $healthCheck->risk_level = $healthCheck->calculateRiskLevel();
        
        // Generate recommendations
        $healthCheck->recommendations = $this->generateRecommendations($healthCheck);
        
        $healthCheck->save();

        return redirect()->route('health-check.result', $healthCheck->id)
            ->with('success', 'Health check completed successfully!');
    }

    public function result($id)
    {
        $healthCheck = HealthCheck::findOrFail($id);
        return view('health-check.result', compact('healthCheck'));
    }

    private function generateRecommendations(HealthCheck $healthCheck)
    {
        $recommendations = [];
        
        // BMI recommendations
        $bmiCategory = $healthCheck->getBMICategory();
        if ($bmiCategory === 'Underweight') {
            $recommendations[] = "Konsultasikan dengan dokter untuk program penambahan berat badan yang sehat.";
            $recommendations[] = "Tingkatkan asupan kalori dengan makanan bergizi tinggi.";
        } elseif ($bmiCategory === 'Overweight' || $bmiCategory === 'Obese') {
            $recommendations[] = "Konsultasikan dengan ahli gizi untuk program penurunan berat badan.";
            $recommendations[] = "Tingkatkan aktivitas fisik dan olahraga rutin.";
        } else {
            $recommendations[] = "Pertahankan berat badan ideal dengan pola makan seimbang.";
        }

        // Exercise recommendations
        if ($healthCheck->exercise_frequency === 'never' || $healthCheck->exercise_frequency === 'rarely') {
            $recommendations[] = "Mulai rutin berolahraga minimal 150 menit per minggu.";
            $recommendations[] = "Pilih aktivitas fisik yang Anda sukai seperti jalan kaki, bersepeda, atau berenang.";
        }

        // Sleep recommendations
        if ($healthCheck->sleep_hours < 7 || $healthCheck->sleep_hours > 9) {
            $recommendations[] = "Usahakan tidur 7-9 jam setiap malam untuk kesehatan optimal.";
            $recommendations[] = "Buat rutinitas tidur yang teratur dan hindari gadget sebelum tidur.";
        }

        // Stress recommendations
        if ($healthCheck->stress_level >= 7) {
            $recommendations[] = "Praktikkan teknik relaksasi seperti meditasi atau yoga.";
            $recommendations[] = "Pertimbangkan konseling jika stress berlanjut.";
        }

        // Smoking recommendations
        if ($healthCheck->smoking_status === 'current') {
            $recommendations[] = "Sangat disarankan untuk berhenti merokok demi kesehatan jangka panjang.";
            $recommendations[] = "Konsultasikan dengan dokter untuk program berhenti merokok.";
        }

        // Alcohol recommendations
        if ($healthCheck->alcohol_consumption === 'heavy') {
            $recommendations[] = "Kurangi konsumsi alkohol untuk mengurangi risiko kesehatan.";
            $recommendations[] = "Pertimbangkan bantuan profesional jika sulit mengurangi konsumsi alkohol.";
        }

        // General recommendations based on risk level
        if ($healthCheck->risk_level === 'high') {
            $recommendations[] = "PENTING: Segera konsultasikan kondisi kesehatan Anda dengan dokter.";
            $recommendations[] = "Lakukan pemeriksaan kesehatan menyeluruh (medical check-up).";
        } elseif ($healthCheck->risk_level === 'moderate') {
            $recommendations[] = "Disarankan untuk konsultasi dengan dokter dalam waktu dekat.";
            $recommendations[] = "Lakukan pemeriksaan kesehatan rutin setiap 6 bulan.";
        } else {
            $recommendations[] = "Lakukan pemeriksaan kesehatan rutin setiap tahun.";
            $recommendations[] = "Pertahankan gaya hidup sehat yang sudah baik.";
        }

        return implode("\n", $recommendations);
    }
}
