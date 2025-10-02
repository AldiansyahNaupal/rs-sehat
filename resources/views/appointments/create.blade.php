@extends('layouts.app')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-r from-primary-600 to-secondary-500 text-white py-16">
        <div class="container-custom text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Buat Janji Temu</h1>
            <p class="text-xl text-blue-100">Isi formulir di bawah untuk membuat janji temu dengan dokter spesialis kami</p>
        </div>
    </section>

    {{-- Form Section --}}
    <section class="section-padding bg-gray-50">
        <div class="container-custom">
            <div class="max-w-4xl mx-auto">
                {{-- Success/Error Messages --}}
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-8">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-8">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Terdapat kesalahan pada formulir:
                        </div>
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Appointment Form --}}
                <x-appointment-form :services="$services" :doctors="$doctors" />

                {{-- Additional Info --}}
                <div class="mt-12 grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Operating Hours --}}
                    <div class="card text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-primary-600 to-secondary-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Jam Operasional</h3>
                        <div class="space-y-2 text-gray-600">
                            <div>Senin - Jumat: 08:00 - 17:00</div>
                            <div>Sabtu: 08:00 - 14:00</div>
                            <div>Minggu: Tutup</div>
                            <div class="text-red-600 font-medium">Darurat: 24/7</div>
                        </div>
                    </div>

                    {{-- Contact Info --}}
                    <div class="card text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-primary-600 to-secondary-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Hubungi Kami</h3>
                        <div class="space-y-2 text-gray-600">
                            <div>Telepon: (021) 123-4567</div>
                            <div>WhatsApp: 08123456789</div>
                            <div>Email: info@rssehat.com</div>
                        </div>
                    </div>

                    {{-- Location --}}
                    <div class="card text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-primary-600 to-secondary-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Lokasi</h3>
                        <div class="space-y-2 text-gray-600">
                            <div>Jl. Kesehatan No. 123</div>
                            <div>Jakarta Pusat, DKI Jakarta</div>
                            <div>Parkir gratis tersedia</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
