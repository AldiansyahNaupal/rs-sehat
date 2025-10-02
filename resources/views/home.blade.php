@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    @include('components.hero')

    {{-- Statistics Section --}}
    @include('components.stat-card', ['stats' => $stats])

    {{-- Services Section --}}
    <section class="section-padding bg-gray-50">
        <div class="container-custom">
            {{-- Section Header --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Layanan Kesehatan Terbaik
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Kami menyediakan berbagai layanan kesehatan dengan teknologi terdepan dan tenaga medis berpengalaman
                </p>
            </div>

            {{-- Services Grid --}}
            @if($services->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($services as $service)
                        <x-service-card :service="$service" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Layanan Belum Tersedia</h3>
                    <p class="text-gray-600">Data layanan akan segera tersedia</p>
                </div>
            @endif

            {{-- View All Services Button --}}
            <div class="text-center">
                <a href="{{ route('services.index') }}" class="btn-primary px-8 py-4">
                    <i class="fas fa-hospital-alt mr-2"></i>
                    Lihat Semua Layanan
                </a>
            </div>
        </div>
    </section>

    {{-- Promo Banner --}}
    @include('components.promo-banner')

    {{-- Doctors Section --}}
    <section class="section-padding bg-white">
        <div class="container-custom">
            {{-- Section Header --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Dokter Spesialis Berpengalaman
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Tim dokter spesialis kami siap memberikan pelayanan terbaik untuk kesehatan Anda
                </p>
            </div>

            {{-- Doctors Grid --}}
            @if($doctors->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                    @foreach($doctors as $doctor)
                        <div class="card text-center group">
                            {{-- Doctor Photo --}}
                            <div class="mb-6">
                                @if($doctor->photo)
                                    <img src="{{ $doctor->photo }}" alt="Dr. {{ $doctor->name }}" 
                                         class="w-24 h-24 rounded-full mx-auto object-cover">
                                @else
                                    <div class="w-24 h-24 bg-gradient-to-r from-primary-600 to-secondary-500 rounded-full flex items-center justify-center mx-auto">
                                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Doctor Info --}}
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-primary-600 transition duration-300">
                                Dr. {{ $doctor->name }}
                            </h3>
                            <p class="text-primary-600 font-medium mb-3">{{ $doctor->specialization }}</p>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($doctor->description, 80) }}</p>
                            
                            <a href="{{ route('doctors.show', $doctor) }}" class="text-primary-600 hover:text-primary-700 font-medium text-sm inline-flex items-center">
                                <i class="fas fa-user-md mr-2"></i>
                                Lihat Profil
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Dokter Belum Tersedia</h3>
                    <p class="text-gray-600">Data dokter akan segera tersedia</p>
                </div>
            @endif

            {{-- View All Doctors Button --}}
            <div class="text-center">
                <a href="{{ route('doctors.index') }}" class="btn-secondary px-8 py-4">
                    <i class="fas fa-user-md mr-2"></i>
                    Lihat Semua Dokter
                </a>
            </div>
        </div>
    </section>

    {{-- Articles Section --}}
    <section class="section-padding bg-gray-50">
        <div class="container-custom">
            {{-- Section Header --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Artikel Kesehatan Terbaru
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Dapatkan informasi kesehatan terkini dari para ahli medis kami
                </p>
            </div>

            {{-- Articles Grid --}}
            @if($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($articles as $article)
                        <x-article-card :article="$article" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 011 1v1m0 0l4 4m0 0v10a2 2 0 01-2 2H7m8-14V9a2 2 0 01-2 2H9"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Artikel Belum Tersedia</h3>
                    <p class="text-gray-600">Artikel kesehatan akan segera tersedia</p>
                </div>
            @endif

            {{-- View All Articles Button --}}
            <div class="text-center">
                <a href="{{ route('articles.index') }}" class="btn-primary px-8 py-4">
                    <i class="fas fa-newspaper mr-2"></i>
                    Baca Artikel Lainnya
                </a>
            </div>
        </div>
    </section>

    {{-- Call to Action Section --}}
    <section class="section-padding bg-white">
        <div class="container-custom text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Siap untuk Konsultasi?
                </h2>
                <p class="text-xl text-gray-600 mb-8">
                    Jangan tunda kesehatan Anda. Buat janji temu dengan dokter spesialis kami sekarang juga.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('appointments.create') }}" class="btn-primary px-8 py-4 text-lg">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Buat Janji Temu
                    </a>
                    <a href="tel:(021)123-4567" class="btn-secondary px-8 py-4 text-lg">
                        <i class="fas fa-phone mr-2"></i>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
