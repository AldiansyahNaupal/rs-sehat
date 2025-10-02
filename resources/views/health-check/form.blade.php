@extends('layouts.app')

@section('content')
{{-- Health Check Form --}}
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            {{-- Header --}}
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-heartbeat mr-3 text-green-600"></i>
                    Health Check Online
                </h1>
                <p class="text-lg text-gray-600">
                    Lengkapi formulir berikut untuk mendapatkan evaluasi kesehatan dan rekomendasi yang tepat
                </p>
            </div>

            {{-- Form --}}
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form action="{{ route('health-check.store') }}" method="POST" id="health-check-form">
                    @csrf
                    
                    {{-- Personal Information --}}
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-user mr-2 text-blue-600"></i>
                            Informasi Pribadi
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror" 
                                       required>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="age" class="block text-sm font-medium text-gray-700 mb-2">Usia *</label>
                                <input type="number" id="age" name="age" value="{{ old('age') }}" min="1" max="120" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('age') border-red-500 @enderror" 
                                       required>
                                @error('age')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin *</label>
                                <select id="gender" name="gender" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('gender') border-red-500 @enderror" 
                                        required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Physical Measurements --}}
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-weight mr-2 text-green-600"></i>
                            Pengukuran Fisik
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="height" class="block text-sm font-medium text-gray-700 mb-2">Tinggi Badan (cm) *</label>
                                <input type="number" id="height" name="height" value="{{ old('height') }}" min="50" max="300" step="0.1" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('height') border-red-500 @enderror" 
                                       required>
                                @error('height')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="weight" class="block text-sm font-medium text-gray-700 mb-2">Berat Badan (kg) *</label>
                                <input type="number" id="weight" name="weight" value="{{ old('weight') }}" min="20" max="500" step="0.1" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('weight') border-red-500 @enderror" 
                                       required>
                                @error('weight')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- BMI Display --}}
                        <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-calculator mr-2 text-blue-600"></i>
                                <span class="text-sm font-medium text-gray-700">BMI Anda: </span>
                                <span id="bmi-result" class="ml-2 font-bold text-blue-600">-</span>
                                <span id="bmi-category" class="ml-2 text-sm text-gray-600">(-)</span>
                            </div>
                        </div>
                    </div>

                    {{-- Lifestyle Factors --}}
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-running mr-2 text-orange-600"></i>
                            Gaya Hidup
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="exercise_frequency" class="block text-sm font-medium text-gray-700 mb-2">Frekuensi Olahraga *</label>
                                <select id="exercise_frequency" name="exercise_frequency" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('exercise_frequency') border-red-500 @enderror" 
                                        required>
                                    <option value="">Pilih Frekuensi</option>
                                    <option value="never" {{ old('exercise_frequency') == 'never' ? 'selected' : '' }}>Tidak pernah</option>
                                    <option value="rarely" {{ old('exercise_frequency') == 'rarely' ? 'selected' : '' }}>Jarang (1-2x per bulan)</option>
                                    <option value="sometimes" {{ old('exercise_frequency') == 'sometimes' ? 'selected' : '' }}>Kadang-kadang (1-2x per minggu)</option>
                                    <option value="often" {{ old('exercise_frequency') == 'often' ? 'selected' : '' }}>Sering (3-4x per minggu)</option>
                                    <option value="daily" {{ old('exercise_frequency') == 'daily' ? 'selected' : '' }}>Setiap hari</option>
                                </select>
                                @error('exercise_frequency')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="sleep_hours" class="block text-sm font-medium text-gray-700 mb-2">Jam Tidur per Hari *</label>
                                <input type="number" id="sleep_hours" name="sleep_hours" value="{{ old('sleep_hours', '8') }}" min="1" max="24" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('sleep_hours') border-red-500 @enderror" 
                                       required>
                                @error('sleep_hours')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="smoking_status" class="block text-sm font-medium text-gray-700 mb-2">Status Merokok *</label>
                                <select id="smoking_status" name="smoking_status" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('smoking_status') border-red-500 @enderror" 
                                        required>
                                    <option value="">Pilih Status</option>
                                    <option value="never" {{ old('smoking_status') == 'never' ? 'selected' : '' }}>Tidak pernah</option>
                                    <option value="former" {{ old('smoking_status') == 'former' ? 'selected' : '' }}>Mantan perokok</option>
                                    <option value="current" {{ old('smoking_status') == 'current' ? 'selected' : '' }}>Perokok aktif</option>
                                </select>
                                @error('smoking_status')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="alcohol_consumption" class="block text-sm font-medium text-gray-700 mb-2">Konsumsi Alkohol *</label>
                                <select id="alcohol_consumption" name="alcohol_consumption" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('alcohol_consumption') border-red-500 @enderror" 
                                        required>
                                    <option value="">Pilih Frekuensi</option>
                                    <option value="never" {{ old('alcohol_consumption') == 'never' ? 'selected' : '' }}>Tidak pernah</option>
                                    <option value="rarely" {{ old('alcohol_consumption') == 'rarely' ? 'selected' : '' }}>Jarang</option>
                                    <option value="moderate" {{ old('alcohol_consumption') == 'moderate' ? 'selected' : '' }}>Sedang</option>
                                    <option value="heavy" {{ old('alcohol_consumption') == 'heavy' ? 'selected' : '' }}>Berat</option>
                                </select>
                                @error('alcohol_consumption')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Stress Level --}}
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-brain mr-2 text-purple-600"></i>
                            Tingkat Stress
                        </h2>
                        <div>
                            <label for="stress_level" class="block text-sm font-medium text-gray-700 mb-2">
                                Tingkat Stress (1 = Sangat Rendah, 10 = Sangat Tinggi) *
                            </label>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm text-gray-500">1</span>
                                <input type="range" id="stress_level" name="stress_level" value="{{ old('stress_level', '5') }}" 
                                       min="1" max="10" class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer stress-slider">
                                <span class="text-sm text-gray-500">10</span>
                                <span id="stress-value" class="ml-4 px-3 py-1 bg-blue-100 text-blue-800 rounded-lg font-medium">5</span>
                            </div>
                            @error('stress_level')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Symptoms Checklist --}}
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-stethoscope mr-2 text-red-600"></i>
                            Gejala yang Dirasakan
                        </h2>
                        <p class="text-sm text-gray-600 mb-4">Pilih gejala yang sedang atau pernah Anda rasakan dalam 3 bulan terakhir:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @php
                                $symptoms = [
                                    'Sakit kepala sering' => 'headache',
                                    'Pusing' => 'dizziness',
                                    'Mual' => 'nausea',
                                    'Nyeri dada' => 'chest_pain',
                                    'Sesak napas' => 'shortness_breath',
                                    'Jantung berdebar' => 'palpitations',
                                    'Mudah lelah' => 'fatigue',
                                    'Nyeri punggung' => 'back_pain',
                                    'Nyeri sendi' => 'joint_pain',
                                    'Sulit tidur' => 'insomnia',
                                    'Sering buang air kecil' => 'frequent_urination',
                                    'Penglihatan kabur' => 'blurred_vision',
                                    'Kehilangan nafsu makan' => 'loss_appetite',
                                    'Berat badan turun drastis' => 'weight_loss',
                                    'Demam berulang' => 'recurring_fever'
                                ];
                            @endphp
                            
                            @foreach($symptoms as $label => $value)
                                <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="checkbox" name="symptoms[]" value="{{ $value }}" 
                                           class="mr-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                           {{ in_array($value, old('symptoms', [])) ? 'checked' : '' }}>
                                    <span class="text-sm text-gray-700">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('symptoms')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="text-center">
                        <button type="submit" class="btn-primary px-8 py-4 text-lg">
                            <i class="fas fa-chart-line mr-2"></i>
                            Analisis Kesehatan Saya
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
// BMI Calculator
function calculateBMI() {
    const height = parseFloat(document.getElementById('height').value);
    const weight = parseFloat(document.getElementById('weight').value);
    
    if (height && weight) {
        const heightInMeters = height / 100;
        const bmi = (weight / (heightInMeters * heightInMeters)).toFixed(1);
        
        let category = '';
        if (bmi < 18.5) {
            category = 'Kurus';
        } else if (bmi < 25) {
            category = 'Normal';
        } else if (bmi < 30) {
            category = 'Gemuk';
        } else {
            category = 'Obesitas';
        }
        
        document.getElementById('bmi-result').textContent = bmi;
        document.getElementById('bmi-category').textContent = `(${category})`;
    }
}

// Stress Level Display
function updateStressValue() {
    const stressLevel = document.getElementById('stress_level').value;
    document.getElementById('stress-value').textContent = stressLevel;
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('height').addEventListener('input', calculateBMI);
    document.getElementById('weight').addEventListener('input', calculateBMI);
    document.getElementById('stress_level').addEventListener('input', updateStressValue);
    
    // Initialize stress value
    updateStressValue();
    
    // Calculate BMI if values exist
    calculateBMI();
});
</script>
@endsection
