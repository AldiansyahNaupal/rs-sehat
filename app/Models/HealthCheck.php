<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'age',
        'gender',
        'height',
        'weight',
        'bmi',
        'symptoms',
        'lifestyle',
        'medical_history',
        'stress_level',
        'sleep_hours',
        'exercise_frequency',
        'smoking_status',
        'alcohol_consumption',
        'recommendations',
        'risk_level'
    ];

    protected $casts = [
        'symptoms' => 'array',
        'lifestyle' => 'array',
        'medical_history' => 'array',
        'height' => 'decimal:2',
        'weight' => 'decimal:2',
        'bmi' => 'decimal:2'
    ];

    // Calculate BMI
    public function calculateBMI()
    {
        if ($this->height && $this->weight) {
            $heightInMeters = $this->height / 100;
            $this->bmi = round($this->weight / ($heightInMeters * $heightInMeters), 2);
            return $this->bmi;
        }
        return null;
    }

    // Get BMI category
    public function getBMICategory()
    {
        if (!$this->bmi) return 'Unknown';
        
        if ($this->bmi < 18.5) return 'Underweight';
        if ($this->bmi < 25) return 'Normal';
        if ($this->bmi < 30) return 'Overweight';
        return 'Obese';
    }

    // Calculate risk level based on various factors
    public function calculateRiskLevel()
    {
        $riskScore = 0;

        // Age factor
        if ($this->age > 65) $riskScore += 3;
        elseif ($this->age > 45) $riskScore += 2;
        elseif ($this->age > 30) $riskScore += 1;

        // BMI factor
        $bmi = $this->bmi ?? $this->calculateBMI();
        if ($bmi >= 30) $riskScore += 3;
        elseif ($bmi >= 25) $riskScore += 2;
        elseif ($bmi < 18.5) $riskScore += 2;

        // Lifestyle factors
        if ($this->smoking_status === 'current') $riskScore += 3;
        elseif ($this->smoking_status === 'former') $riskScore += 1;

        if ($this->alcohol_consumption === 'heavy') $riskScore += 2;
        elseif ($this->alcohol_consumption === 'moderate') $riskScore += 1;

        if ($this->exercise_frequency === 'never') $riskScore += 2;
        elseif ($this->exercise_frequency === 'rarely') $riskScore += 1;

        if ($this->stress_level >= 8) $riskScore += 2;
        elseif ($this->stress_level >= 6) $riskScore += 1;

        if ($this->sleep_hours < 6 || $this->sleep_hours > 9) $riskScore += 1;

        // Symptoms factor
        if (count($this->symptoms ?? []) > 5) $riskScore += 3;
        elseif (count($this->symptoms ?? []) > 2) $riskScore += 2;
        elseif (count($this->symptoms ?? []) > 0) $riskScore += 1;

        // Determine risk level
        if ($riskScore >= 8) return 'high';
        if ($riskScore >= 4) return 'moderate';
        return 'low';
    }
}