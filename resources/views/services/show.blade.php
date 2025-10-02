@extends('layouts.app')

@section('title', $service->name . ' - RS Sehat')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary-600">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('services.index') }}" class="hover:text-primary-600">Layanan</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-800">{{ $service->name }}</span>
        </nav>

        <div class="max-w-6xl mx-auto">
            <!-- Service Header -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
                <div class="relative">
                    <!-- Hero Background -->
                    <div class="h-64 bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center relative">
                        <i class="{{ $service->icon ?? 'fas fa-hospital' }} text-white text-8xl"></i>
                        <div class="absolute inset-0 bg-black opacity-10"></div>
                    </div>
                    
                    <!-- Service Info Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-8">
                        <div class="flex items-center justify-between text-white">
                            <div>
                                <h1 class="text-4xl font-bold mb-2">{{ $service->name }}</h1>
                                <div class="flex items-center space-x-4">
                                    <span class="bg-white/20 px-3 py-1 rounded-full text-sm">
                                        @if(str_contains($service->name, 'Spesialis'))
                                            Layanan Spesialis
                                        @elseif(str_contains($service->name, 'Check Up'))
                                            Medical Check Up
                                        @elseif(in_array($service->name, ['Laboratorium', 'Radiologi']))
                                            Layanan Penunjang
                                        @else
                                            Layanan Umum
                                        @endif
                                    </span>
                                    @if($service->is_active)
                                    <span class="bg-green-500/80 px-3 py-1 rounded-full text-sm">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Tersedia
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            @if($service->price)
                            <div class="text-right">
                                <p class="text-sm opacity-80">Mulai dari</p>
                                <p class="text-3xl font-bold">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Service Description -->
                    <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tentang Layanan</h2>
                        <div class="prose prose-lg max-w-none text-gray-600">
                            <p>{{ $service->description }}</p>
                        </div>
                    </div>

                    <!-- Service Features -->
                    <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Keunggulan Layanan</h2>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-user-md text-primary-600 text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-1">Dokter Spesialis</h3>
                                    <p class="text-gray-600 text-sm">Tim medis berpengalaman dan bersertifikat</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-secondary-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-microscope text-secondary-600 text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-1">Teknologi Canggih</h3>
                                    <p class="text-gray-600 text-sm">Peralatan medis terdepan dan modern</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-shield-alt text-blue-600 text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-1">Standar Internasional</h3>
                                    <p class="text-gray-600 text-sm">Mengikuti protokol medis terkini</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-clock text-green-600 text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-1">Layanan Cepat</h3>
                                    <p class="text-gray-600 text-sm">Proses pelayanan yang efisien</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-certificate text-purple-600 text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-1">Akreditasi Resmi</h3>
                                    <p class="text-gray-600 text-sm">Terakreditasi oleh lembaga kesehatan nasional</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-handshake text-yellow-600 text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-1">Pelayanan Prima</h3>
                                    <p class="text-gray-600 text-sm">Komitmen memberikan pengalaman terbaik</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- What to Expect -->
                    <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Proses Layanan</h2>
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">
                                    1
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-2">Pendaftaran</h3>
                                    <p class="text-gray-600">Daftar melalui website atau datang langsung ke rumah sakit untuk membuat janji konsultasi.</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">
                                    2
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-2">Pemeriksaan Awal</h3>
                                    <p class="text-gray-600">Tim medis akan melakukan pemeriksaan awal dan pencatatan riwayat kesehatan.</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">
                                    3
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-2">Diagnosis & Pengobatan</h3>
                                    <p class="text-gray-600">Dokter spesialis akan memberikan diagnosis dan rencana pengobatan yang tepat.</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">
                                    4
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-2">Follow Up</h3>
                                    <p class="text-gray-600">Kontrol berkelanjutan untuk memastikan proses penyembuhan berjalan optimal.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Quick Action Card -->
                    <div class="bg-white rounded-xl shadow-md p-6 mb-8 top-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">Buat Janji Sekarang</h3>
                        
                        @if($service->price)
                        <div class="bg-primary-50 rounded-lg p-4 mb-6">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Biaya Konsultasi:</span>
                                <span class="text-2xl font-bold text-primary-600">
                                    Rp {{ number_format($service->price, 0, ',', '.') }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">*Belum termasuk tindakan medis tambahan</p>
                        </div>
                        @endif
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-clock text-primary-500 mr-3"></i>
                                <span>Senin - Minggu: 08:00 - 20:00</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-map-marker-alt text-primary-500 mr-3"></i>
                                <span>RS Sehat, Jakarta</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-phone text-primary-500 mr-3"></i>
                                <span>(021) 1234-567</span>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <a href="{{ route('appointments.create', ['service_id' => $service->id]) }}" 
                               class="w-full bg-primary-600 text-white py-3 px-4 rounded-lg hover:bg-primary-700 transition-colors font-semibold text-center block">
                                <i class="fas fa-calendar-plus mr-2"></i>
                                Buat Janji
                            </a>
                            
                            <a href="tel:+62211234567" 
                               class="w-full border border-primary-600 text-primary-600 py-3 px-4 rounded-lg hover:bg-primary-50 transition-colors font-semibold text-center block">
                                <i class="fas fa-phone mr-2"></i>
                                Hubungi Kami
                            </a>
                            
                            <a href="https://wa.me/62811234567?text=Halo, saya ingin konsultasi tentang {{ $service->name }}" 
                               target="_blank"
                               class="w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 transition-colors font-semibold text-center block">
                                <i class="fab fa-whatsapp mr-2"></i>
                                WhatsApp
                            </a>
                        </div>
                    </div>

                    <!-- Related Services -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">Layanan Terkait</h3>
                        <div class="space-y-4">
                            @php
                                $relatedServices = \App\Models\Service::where('id', '!=', $service->id)
                                    ->active()
                                    ->take(3)
                                    ->get();
                            @endphp
                            
                            @foreach($relatedServices as $related)
                            <div class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition-colors">
                                <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="{{ $related->icon ?? 'fas fa-hospital' }} text-primary-600"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium text-gray-800 truncate">
                                        <a href="{{ route('services.show', $related) }}" class="hover:text-primary-600">
                                            {{ $related->name }}
                                        </a>
                                    </h4>
                                    @if($related->price)
                                    <p class="text-sm text-gray-500">
                                        Rp {{ number_format($related->price, 0, ',', '.') }}
                                    </p>
                                    @endif
                                </div>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-6">
                            <a href="{{ route('services.index') }}" 
                               class="w-full text-center block text-primary-600 hover:text-primary-700 font-medium">
                                Lihat Semua Layanan
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
