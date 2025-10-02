@extends('layouts.app')

@section('title', 'Dr. ' . $doctor->name . ' - ' . $doctor->specialization . ' - RS Sehat')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary-600">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('doctors.index') }}" class="hover:text-primary-600">Dokter</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-800">Dr. {{ $doctor->name }}</span>
        </nav>

        <div class="max-w-6xl mx-auto">
            <!-- Doctor Profile Header -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
                <div class="relative">
                    <!-- Background Pattern -->
                    <div class="h-32 bg-gradient-to-br from-primary-500 to-primary-700 relative">
                        <div class="absolute inset-0 opacity-10">
                            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <pattern id="medical-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                        <path d="M10 2L10 18M2 10L18 10" stroke="white" stroke-width="1" fill="none"/>
                                    </pattern>
                                </defs>
                                <rect width="100" height="100" fill="url(#medical-pattern)"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Doctor Info -->
                    <div class="relative px-8 pb-8">
                        <div class="flex flex-col md:flex-row items-start md:items-end space-y-4 md:space-y-0 md:space-x-6">
                            <!-- Doctor Photo -->
                            <div class="relative -mt-16">
                                @if($doctor->photo)
                                <img src="{{ $doctor->photo }}" alt="Dr. {{ $doctor->name }}" 
                                     class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover">
                                @else
                                <div class="w-32 h-32 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                                    <i class="fas fa-user-md text-white text-4xl"></i>
                                </div>
                                @endif
                                
                                <!-- Online Status -->
                                @if($doctor->is_available)
                                <div class="absolute -bottom-2 -right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full flex items-center">
                                    <div class="w-2 h-2 bg-white rounded-full mr-1 animate-pulse"></div>
                                    Online
                                </div>
                                @else
                                <div class="absolute -bottom-2 -right-2 bg-gray-500 text-white text-xs px-2 py-1 rounded-full">
                                    Offline
                                </div>
                                @endif
                            </div>
                            
                            <!-- Doctor Details -->
                            <div class="flex-1">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Dr. {{ $doctor->name }}</h1>
                                        <div class="flex flex-wrap items-center gap-4 mb-4">
                                            <span class="bg-primary-100 text-primary-600 px-4 py-2 rounded-full font-medium">
                                                {{ $doctor->specialization }}
                                            </span>
                                            <div class="flex items-center text-gray-600">
                                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                                <span class="font-medium">{{ $doctor->rating ?? '4.8' }}</span>
                                                <span class="text-sm ml-1">({{ $doctor->reviews_count ?? '127' }} ulasan)</span>
                                            </div>
                                            <div class="flex items-center text-gray-600">
                                                <i class="fas fa-graduation-cap mr-2"></i>
                                                <span>{{ $doctor->years_experience ?? '10' }}+ tahun pengalaman</span>
                                            </div>
                                        </div>
                                        <p class="text-gray-600 max-w-2xl">{{ $doctor->bio ?? 'Dokter spesialis berpengalaman dengan dedikasi tinggi dalam memberikan pelayanan kesehatan terbaik untuk pasien.' }}</p>
                                    </div>
                                    
                                    <!-- Quick Actions -->
                                    <div class="flex flex-col gap-3 mt-4 md:mt-0">
                                        <a href="{{ route('appointments.create', ['doctor_id' => $doctor->id]) }}" 
                                           class="bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-700 transition-colors font-semibold text-center">
                                            <i class="fas fa-calendar-plus mr-2"></i>
                                            Buat Janji
                                        </a>
                                        <a href="https://wa.me/62811234567?text=Halo, saya ingin konsultasi dengan Dr. {{ $doctor->name }}" 
                                           target="_blank"
                                           class="border border-primary-600 text-primary-600 px-6 py-3 rounded-lg hover:bg-primary-50 transition-colors font-semibold text-center">
                                            <i class="fab fa-whatsapp mr-2"></i>
                                            WhatsApp
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- About Doctor -->
                    <div class="bg-white rounded-xl shadow-md p-8">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tentang Dokter</h2>
                        <div class="prose prose-lg max-w-none text-gray-600">
                            <p>{{ $doctor->description ?? 'Dr. ' . $doctor->name . ' adalah seorang dokter spesialis ' . strtolower($doctor->specialization) . ' yang berpengalaman dengan dedikasi tinggi dalam memberikan pelayanan kesehatan terbaik. Beliau telah menangani ribuan pasien dengan berbagai kondisi medis dan selalu mengutamakan kepuasan serta kesembuhan pasien.' }}</p>
                        </div>
                    </div>

                    <!-- Education & Experience -->
                    <div class="bg-white rounded-xl shadow-md p-8">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Pendidikan & Pengalaman</h2>
                        
                        <!-- Education -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-graduation-cap text-primary-600 mr-3"></i>
                                Pendidikan
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-4">
                                    <div class="w-2 h-2 bg-primary-600 rounded-full mt-3 flex-shrink-0"></div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">Spesialis {{ $doctor->specialization }}</h4>
                                        <p class="text-gray-600">Universitas Indonesia - {{ 2024 - ($doctor->years_experience ?? 10) }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="w-2 h-2 bg-primary-600 rounded-full mt-3 flex-shrink-0"></div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">Dokter Umum</h4>
                                        <p class="text-gray-600">Universitas Indonesia - {{ 2024 - ($doctor->years_experience ?? 10) - 4 }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Experience -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-briefcase text-secondary-600 mr-3"></i>
                                Pengalaman Kerja
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-4">
                                    <div class="w-2 h-2 bg-secondary-600 rounded-full mt-3 flex-shrink-0"></div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">Dokter Spesialis {{ $doctor->specialization }}</h4>
                                        <p class="text-gray-600">RS Sehat - {{ 2024 - ($doctor->years_experience ?? 10) + 2 }} - Sekarang</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="w-2 h-2 bg-secondary-600 rounded-full mt-3 flex-shrink-0"></div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">Residen {{ $doctor->specialization }}</h4>
                                        <p class="text-gray-600">RSUPN Dr. Cipto Mangunkusumo - {{ 2024 - ($doctor->years_experience ?? 10) }} - {{ 2024 - ($doctor->years_experience ?? 10) + 2 }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Specializations & Services -->
                    <div class="bg-white rounded-xl shadow-md p-8">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Keahlian & Layanan</h2>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Keahlian Utama</h3>
                                <div class="space-y-3">
                                    @php
                                        $specialties = [
                                            'Jantung' => ['Kateterisasi Jantung', 'Echocardiography', 'EKG & Stress Test', 'Bedah Jantung'],
                                            'Saraf' => ['CT Scan Otak', 'MRI Otak', 'EEG', 'Terapi Stroke'],
                                            'Tulang' => ['Arthroscopy', 'Replacement Joint', 'Spine Surgery', 'Sports Medicine'],
                                            'default' => ['Konsultasi Umum', 'Pemeriksaan Rutin', 'Diagnosis', 'Terapi Medis']
                                        ];
                                        $doctorSpecialties = $specialties[$doctor->specialization] ?? $specialties['default'];
                                    @endphp
                                    
                                    @foreach($doctorSpecialties as $specialty)
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-check-circle text-green-500 text-sm"></i>
                                        <span class="text-gray-700">{{ $specialty }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Kondisi yang Ditangani</h3>
                                <div class="space-y-3">
                                    @php
                                        $conditions = [
                                            'Jantung' => ['Penyakit Jantung Koroner', 'Gagal Jantung', 'Aritmia', 'Hipertensi'],
                                            'Saraf' => ['Stroke', 'Epilepsi', 'Migrain', 'Parkinson'],
                                            'Tulang' => ['Arthritis', 'Osteoporosis', 'Patah Tulang', 'Cedera Olahraga'],
                                            'default' => ['Demam', 'Batuk Pilek', 'Sakit Kepala', 'Gangguan Pencernaan']
                                        ];
                                        $doctorConditions = $conditions[$doctor->specialization] ?? $conditions['default'];
                                    @endphp
                                    
                                    @foreach($doctorConditions as $condition)
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-stethoscope text-primary-500 text-sm"></i>
                                        <span class="text-gray-700">{{ $condition }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Patient Reviews -->
                    <div class="bg-white rounded-xl shadow-md p-8">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Ulasan Pasien</h2>
                        
                        <!-- Rating Summary -->
                        <div class="bg-gray-50 rounded-lg p-6 mb-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="flex items-center mb-2">
                                        <span class="text-3xl font-bold text-gray-800 mr-2">{{ $doctor->rating ?? '4.8' }}</span>
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= ($doctor->rating ?? 4.8) ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-gray-600">Berdasarkan {{ $doctor->reviews_count ?? '127' }} ulasan</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-green-600">{{ $doctor->recommendation_rate ?? '96' }}%</p>
                                    <p class="text-gray-600 text-sm">Tingkat Rekomendasi</p>
                                </div>
                            </div>
                        </div>

                        <!-- Sample Reviews -->
                        <div class="space-y-6">
                            <div class="border-l-4 border-primary-500 pl-6">
                                <div class="flex items-center mb-2">
                                    <div class="flex items-center mr-4">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        @endfor
                                    </div>
                                    <span class="font-medium text-gray-800">Sarah M.</span>
                                    <span class="text-gray-500 text-sm ml-2">• 2 minggu lalu</span>
                                </div>
                                <p class="text-gray-700">"Dr. {{ $doctor->name }} sangat profesional dan ramah. Penjelasan yang diberikan sangat detail dan mudah dipahami. Pelayanan yang memuaskan!"</p>
                            </div>
                            
                            <div class="border-l-4 border-secondary-500 pl-6">
                                <div class="flex items-center mb-2">
                                    <div class="flex items-center mr-4">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }} text-sm"></i>
                                        @endfor
                                    </div>
                                    <span class="font-medium text-gray-800">Ahmad R.</span>
                                    <span class="text-gray-500 text-sm ml-2">• 1 bulan lalu</span>
                                </div>
                                <p class="text-gray-700">"Pengalaman konsultasi yang sangat baik. Dokter sangat sabar dalam mendengarkan keluhan dan memberikan solusi yang tepat."</p>
                            </div>
                            
                            <div class="border-l-4 border-blue-500 pl-6">
                                <div class="flex items-center mb-2">
                                    <div class="flex items-center mr-4">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        @endfor
                                    </div>
                                    <span class="font-medium text-gray-800">Maria L.</span>
                                    <span class="text-gray-500 text-sm ml-2">• 1 bulan lalu</span>
                                </div>
                                <p class="text-gray-700">"Highly recommended! Dr. {{ $doctor->name }} memberikan pelayanan terbaik dengan diagnosis yang akurat."</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Schedule & Contact -->
                    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">Jadwal & Kontak</h3>
                        
                        <!-- Schedule -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-calendar-alt text-primary-600 mr-3"></i>
                                Jadwal Praktik
                            </h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Senin - Jumat</span>
                                    <span class="font-medium text-gray-800">08:00 - 16:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Sabtu</span>
                                    <span class="font-medium text-gray-800">08:00 - 12:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Minggu</span>
                                    <span class="text-red-600">Tutup</span>
                                </div>
                            </div>
                        </div>

                        <!-- Consultation Fee -->
                        <div class="bg-primary-50 rounded-lg p-4 mb-6">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Biaya Konsultasi:</span>
                                <span class="text-2xl font-bold text-primary-600">
                                    Rp {{ number_format($doctor->consultation_fee ?? 300000, 0, ',', '.') }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">*Belum termasuk tindakan medis</p>
                        </div>

                        <!-- Contact Info -->
                        <div class="space-y-4 mb-6">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-map-marker-alt text-primary-500 mr-3"></i>
                                <span>{{ $doctor->hospital ?? 'RS Sehat' }}, Jakarta</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-phone text-primary-500 mr-3"></i>
                                <span>(021) 1234-567</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-envelope text-primary-500 mr-3"></i>
                                <span>{{ strtolower(str_replace(' ', '.', $doctor->name)) }}@rssehat.com</span>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="space-y-3">
                            <a href="{{ route('appointments.create', ['doctor_id' => $doctor->id]) }}" 
                               class="w-full bg-primary-600 text-white py-3 px-4 rounded-lg hover:bg-primary-700 transition-colors font-semibold text-center block">
                                <i class="fas fa-calendar-plus mr-2"></i>
                                Buat Janji Konsultasi
                            </a>
                            
                            <a href="tel:+62211234567" 
                               class="w-full border border-primary-600 text-primary-600 py-3 px-4 rounded-lg hover:bg-primary-50 transition-colors font-semibold text-center block">
                                <i class="fas fa-phone mr-2"></i>
                                Hubungi Rumah Sakit
                            </a>
                            
                            <a href="https://wa.me/62811234567?text=Halo, saya ingin konsultasi dengan Dr. {{ $doctor->name }}" 
                               target="_blank"
                               class="w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 transition-colors font-semibold text-center block">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Chat WhatsApp
                            </a>
                        </div>
                    </div>

                    <!-- Hospital Location -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Lokasi Praktik</h3>
                        <div class="mb-4">
                            <h4 class="font-medium text-gray-800">{{ $doctor->hospital ?? 'RS Sehat' }}</h4>
                            <p class="text-gray-600 text-sm">Jl. Sudirman No. 123, Jakarta Pusat</p>
                        </div>
                        
                        <!-- Map Placeholder -->
                        <div class="h-32 bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-map-marker-alt text-gray-400 text-2xl"></i>
                        </div>
                        
                        <a href="#" class="text-primary-600 hover:text-primary-700 font-medium text-sm">
                            <i class="fas fa-directions mr-2"></i>
                            Dapatkan Petunjuk Arah
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
