{{-- Statistics Section --}}
<section class="bg-white py-16">
    <div class="container-custom">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            {{-- Rumah Sakit --}}
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-primary-600 to-secondary-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['hospitals'] ?? 40 }}+</div>
                <div class="text-gray-600 font-medium">Rumah Sakit</div>
            </div>

            {{-- Tenaga Medis --}}
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-primary-600 to-secondary-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($stats['medical_staff'] ?? 2500) }}+</div>
                <div class="text-gray-600 font-medium">Tenaga Medis</div>
            </div>

            {{-- Pasien --}}
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-primary-600 to-secondary-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($stats['patients'] ?? 50000) }}+</div>
                <div class="text-gray-600 font-medium">Pasien Dipercaya</div>
            </div>

            {{-- Asuransi --}}
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-primary-600 to-secondary-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['insurance'] ?? 150 }}+</div>
                <div class="text-gray-600 font-medium">Kerjasama Asuransi</div>
            </div>
        </div>
    </div>
</section>
