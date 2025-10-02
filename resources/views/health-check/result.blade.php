@extends('layouts.app')

@section('content')
{{-- Result Hero Section --}}
<section class="bg-gradient-to-r from-green-600 to-blue-600 text-white py-16">
    <div class="container-custom text-center">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <i class="fas fa-check-circle text-6xl text-green-300"></i>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold mb-4">
                Health Check Selesai!
            </h1>
            <p class="text-xl text-green-100">
                Berikut adalah hasil evaluasi kesehatan untuk <strong>{{ $healthCheck->name }}</strong>
            </p>
        </div>
    </div>
</section>

{{-- Results Section --}}
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Risk Level Card --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tingkat Risiko Kesehatan</h3>
                        
                        @php
                            $riskColors = [
                                'low' => ['bg-green-100', 'text-green-800', 'border-green-200', 'Rendah'],
                                'moderate' => ['bg-yellow-100', 'text-yellow-800', 'border-yellow-200', 'Sedang'],
                                'high' => ['bg-red-100', 'text-red-800', 'border-red-200', 'Tinggi']
                            ];
                            $risk = $riskColors[$healthCheck->risk_level] ?? $riskColors['low'];
                        @endphp
                        
                        <div class="w-24 h-24 mx-auto mb-4 {{ $risk[0] }} {{ $risk[2] }} border-4 rounded-full flex items-center justify-center">
                            @if($healthCheck->risk_level === 'low')
                                <i class="fas fa-shield-alt text-3xl text-green-600"></i>
                            @elseif($healthCheck->risk_level === 'moderate')
                                <i class="fas fa-exclamation-triangle text-3xl text-yellow-600"></i>
                            @else
                                <i class="fas fa-exclamation-circle text-3xl text-red-600"></i>
                            @endif
                        </div>
                        
                        <span class="inline-block px-4 py-2 {{ $risk[0] }} {{ $risk[1] }} rounded-full font-semibold text-lg">
                            {{ $risk[3] }}
                        </span>
                    </div>
                </div>

                {{-- BMI and Physical Data --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-weight mr-2 text-blue-600"></i>
                            Data Fisik & BMI
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="text-gray-600">Usia:</span>
                                    <span class="font-semibold">{{ $healthCheck->age }} tahun</span>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="text-gray-600">Jenis Kelamin:</span>
                                    <span class="font-semibold">{{ $healthCheck->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}</span>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="text-gray-600">Tinggi Badan:</span>
                                    <span class="font-semibold">{{ $healthCheck->height }} cm</span>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="text-gray-600">Berat Badan:</span>
                                    <span class="font-semibold">{{ $healthCheck->weight }} kg</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-center">
                                <div class="text-center">
                                    <div class="w-32 h-32 mx-auto mb-4 bg-blue-100 border-4 border-blue-200 rounded-full flex items-center justify-center">
                                        <div>
                                            <div class="text-2xl font-bold text-blue-800">{{ $healthCheck->bmi }}</div>
                                            <div class="text-sm text-blue-600">BMI</div>
                                        </div>
                                    </div>
                                    
                                    @php
                                        $bmiCategory = $healthCheck->getBMICategory();
                                        $bmiColors = [
                                            'Underweight' => ['text-blue-600', 'Kurus'],
                                            'Normal' => ['text-green-600', 'Normal'],
                                            'Overweight' => ['text-yellow-600', 'Gemuk'],
                                            'Obese' => ['text-red-600', 'Obesitas']
                                        ];
                                        $bmi = $bmiColors[$bmiCategory] ?? ['text-gray-600', 'Unknown'];
                                    @endphp
                                    
                                    <span class="inline-block px-3 py-1 bg-gray-100 {{ $bmi[0] }} rounded-full font-semibold">
                                        {{ $bmi[1] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Lifestyle Summary --}}
            <div class="mt-8 bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-running mr-2 text-orange-600"></i>
                    Ringkasan Gaya Hidup
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <i class="fas fa-dumbbell text-2xl text-orange-600 mb-2"></i>
                        <div class="text-sm text-gray-600 mb-1">Olahraga</div>
                        <div class="font-semibold">
                            @switch($healthCheck->exercise_frequency)
                                @case('never') Tidak pernah @break
                                @case('rarely') Jarang @break
                                @case('sometimes') Kadang-kadang @break
                                @case('often') Sering @break
                                @case('daily') Setiap hari @break
                            @endswitch
                        </div>
                    </div>
                    
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <i class="fas fa-bed text-2xl text-blue-600 mb-2"></i>
                        <div class="text-sm text-gray-600 mb-1">Tidur</div>
                        <div class="font-semibold">{{ $healthCheck->sleep_hours }} jam/hari</div>
                    </div>
                    
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <i class="fas fa-smoking text-2xl text-red-600 mb-2"></i>
                        <div class="text-sm text-gray-600 mb-1">Merokok</div>
                        <div class="font-semibold">
                            @switch($healthCheck->smoking_status)
                                @case('never') Tidak pernah @break
                                @case('former') Mantan perokok @break
                                @case('current') Perokok aktif @break
                            @endswitch
                        </div>
                    </div>
                    
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <i class="fas fa-brain text-2xl text-purple-600 mb-2"></i>
                        <div class="text-sm text-gray-600 mb-1">Tingkat Stress</div>
                        <div class="font-semibold">{{ $healthCheck->stress_level }}/10</div>
                    </div>
                </div>
            </div>

            {{-- Symptoms (if any) --}}
            @if($healthCheck->symptoms && count($healthCheck->symptoms) > 0)
            <div class="mt-8 bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-stethoscope mr-2 text-red-600"></i>
                    Gejala yang Dilaporkan
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    @php
                        $symptomLabels = [
                            'headache' => 'Sakit kepala sering',
                            'dizziness' => 'Pusing',
                            'nausea' => 'Mual',
                            'chest_pain' => 'Nyeri dada',
                            'shortness_breath' => 'Sesak napas',
                            'palpitations' => 'Jantung berdebar',
                            'fatigue' => 'Mudah lelah',
                            'back_pain' => 'Nyeri punggung',
                            'joint_pain' => 'Nyeri sendi',
                            'insomnia' => 'Sulit tidur',
                            'frequent_urination' => 'Sering buang air kecil',
                            'blurred_vision' => 'Penglihatan kabur',
                            'loss_appetite' => 'Kehilangan nafsu makan',
                            'weight_loss' => 'Berat badan turun drastis',
                            'recurring_fever' => 'Demam berulang'
                        ];
                    @endphp
                    
                    @foreach($healthCheck->symptoms as $symptom)
                        <div class="flex items-center p-3 bg-red-50 border border-red-200 rounded-lg">
                            <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                            <span class="text-sm text-red-800">{{ $symptomLabels[$symptom] ?? $symptom }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Recommendations --}}
            <div class="mt-8 bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-lightbulb mr-2 text-yellow-600"></i>
                    Rekomendasi Kesehatan
                </h3>
                
                <div class="prose max-w-none">
                    @foreach(explode("\n", $healthCheck->recommendations) as $recommendation)
                        @if(trim($recommendation))
                            <div class="flex items-start mb-4 p-4 bg-blue-50 border-l-4 border-blue-400 rounded-r-lg">
                                <i class="fas fa-check-circle text-blue-600 mr-3 mt-1 flex-shrink-0"></i>
                                <p class="text-gray-700 mb-0">{{ trim($recommendation) }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Next Steps --}}
            <div class="mt-8 bg-gradient-to-r from-blue-600 to-green-600 text-white rounded-xl p-8 text-center">
                <h3 class="text-2xl font-bold mb-4">Langkah Selanjutnya</h3>
                <p class="text-lg mb-6">
                    Jangan biarkan kesehatan Anda menunggu. Ambil tindakan sekarang untuk hidup yang lebih sehat!
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('appointments.create') }}" class="btn-primary bg-white text-blue-600 hover:bg-gray-100 px-6 py-3">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Buat Janji dengan Dokter
                    </a>
                    <a href="{{ route('health-check.create') }}" class="btn-outline border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3">
                        <i class="fas fa-redo mr-2"></i>
                        Lakukan Health Check Lagi
                    </a>
                    <a href="{{ route('services.index') }}" class="btn-outline border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3">
                        <i class="fas fa-hospital-alt mr-2"></i>
                        Lihat Layanan Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Disclaimer --}}
<section class="section-padding bg-yellow-50 border-t-4 border-yellow-400">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto text-center">
            <div class="flex items-center justify-center mb-4">
                <i class="fas fa-exclamation-triangle text-2xl text-yellow-600 mr-2"></i>
                <h3 class="text-lg font-semibold text-gray-900">Disclaimer Medis</h3>
            </div>
            <p class="text-gray-700">
                Hasil health check ini bersifat umum dan <strong>tidak menggantikan konsultasi medis profesional</strong>. 
                Untuk diagnosis yang akurat dan penanganan yang tepat, selalu konsultasikan dengan dokter atau tenaga medis yang qualified. 
                Jika Anda mengalami gejala yang mengkhawatirkan, segera hubungi layanan medis darurat.
            </p>
        </div>
    </div>
</section>
@endsection
