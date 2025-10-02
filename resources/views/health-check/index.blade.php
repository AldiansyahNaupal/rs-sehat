@extends('layouts.app')

@section('content')
{{-- Hero Section for Health Check --}}
<section class="bg-gradient-to-r from-green-600 to-blue-600 text-white py-20">
    <div class="container-custom text-center">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">
                <i class="fas fa-heartbeat mr-4"></i>
                Cek Kesehatan Online
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-green-100">
                Evaluasi kondisi kesehatan Anda dengan mudah dan dapatkan rekomendasi yang tepat
            </p>
            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 mb-8">
                <p class="text-lg mb-4">
                    <i class="fas fa-info-circle mr-2"></i>
                    Health Check ini akan mengevaluasi:
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                    <div class="flex items-center">
                        <i class="fas fa-weight text-yellow-300 mr-3"></i>
                        <span>Indeks Massa Tubuh (BMI)</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-brain text-yellow-300 mr-3"></i>
                        <span>Tingkat Stress</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-bed text-yellow-300 mr-3"></i>
                        <span>Kualitas Tidur</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-running text-yellow-300 mr-3"></i>
                        <span>Aktivitas Fisik</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-smoking text-yellow-300 mr-3"></i>
                        <span>Gaya Hidup</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-yellow-300 mr-3"></i>
                        <span>Faktor Risiko Kesehatan</span>
                    </div>
                </div>
            </div>
            <a href="{{ route('health-check.create') }}" class="btn-primary px-8 py-4 text-lg">
                <i class="fas fa-play mr-2"></i>
                Mulai Health Check
            </a>
        </div>
    </div>
</section>

{{-- Features Section --}}
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Mengapa Perlu Health Check?
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Deteksi dini dan pencegahan adalah kunci hidup sehat yang optimal
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Feature 1 --}}
            <div class="bg-white rounded-xl p-8 shadow-lg text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-search-plus text-2xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Deteksi Dini</h3>
                <p class="text-gray-600">
                    Identifikasi potensi masalah kesehatan sebelum menjadi serius dengan screening komprehensif.
                </p>
            </div>

            {{-- Feature 2 --}}
            <div class="bg-white rounded-xl p-8 shadow-lg text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-clipboard-list text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Rekomendasi Personal</h3>
                <p class="text-gray-600">
                    Dapatkan saran kesehatan yang disesuaikan dengan kondisi dan gaya hidup Anda.
                </p>
            </div>

            {{-- Feature 3 --}}
            <div class="bg-white rounded-xl p-8 shadow-lg text-center">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-chart-line text-2xl text-yellow-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Monitoring Berkala</h3>
                <p class="text-gray-600">
                    Pantau perkembangan kesehatan Anda secara rutin untuk hidup yang lebih berkualitas.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Disclaimer Section --}}
<section class="section-padding bg-yellow-50 border-l-4 border-yellow-400">
    <div class="container-custom">
        <div class="flex items-start">
            <div class="flex-shrink-0 mr-4">
                <i class="fas fa-exclamation-triangle text-2xl text-yellow-600"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Disclaimer Penting</h3>
                <p class="text-gray-700 mb-4">
                    Health Check online ini adalah alat screening awal dan <strong>TIDAK MENGGANTIKAN</strong> konsultasi medis profesional. 
                    Hasil yang diberikan bersifat umum dan tidak dapat digunakan sebagai diagnosis medis.
                </p>
                <p class="text-gray-700">
                    Untuk diagnosis yang akurat dan penanganan medis yang tepat, selalu konsultasikan dengan dokter atau tenaga medis profesional.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="section-padding bg-blue-600 text-white text-center">
    <div class="container-custom">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">
            Mulai Perjalanan Hidup Sehat Anda
        </h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">
            Hanya butuh 5-10 menit untuk mendapatkan insight tentang kesehatan Anda
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('health-check.create') }}" class="btn-primary bg-white text-blue-600 hover:bg-gray-100 px-8 py-4">
                <i class="fas fa-heartbeat mr-2"></i>
                Mulai Health Check Sekarang
            </a>
            <a href="{{ route('appointments.create') }}" class="btn-outline border-white text-white hover:bg-white hover:text-blue-600 px-8 py-4">
                <i class="fas fa-calendar-plus mr-2"></i>
                Atau Buat Janji dengan Dokter
            </a>
        </div>
    </div>
</section>
@endsection
