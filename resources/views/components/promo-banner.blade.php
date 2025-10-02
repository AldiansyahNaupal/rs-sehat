{{-- Promo Banner Section --}}
<section class="bg-gradient-to-r from-secondary-500 to-primary-600 text-white py-16">
    <div class="container-custom">
        <div class="text-center max-w-4xl mx-auto">
            {{-- Promo Badge --}}
            <div class="inline-block bg-yellow-400 text-gray-900 px-4 py-2 rounded-full text-sm font-semibold mb-6">
                🎉 PROMO SPESIAL
            </div>

            {{-- Main Heading --}}
            <h2 class="text-3xl md:text-4xl font-bold mb-6">
                Medical Check Up Lengkap
                <span class="text-yellow-300">Diskon 30%</span>
            </h2>

            {{-- Description --}}
            <p class="text-xl mb-8 text-blue-100">
                Dapatkan pemeriksaan kesehatan menyeluruh dengan teknologi terdepan. 
                Paket lengkap mulai dari Rp 1.500.000 (harga normal Rp 2.100.000)
            </p>

            {{-- Features List --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-left">
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                        <svg class="w-4 h-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-1">Pemeriksaan Darah Lengkap</h4>
                        <p class="text-sm text-blue-100">Cek fungsi organ vital</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                        <svg class="w-4 h-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-1">EKG & Rontgen Dada</h4>
                        <p class="text-sm text-blue-100">Pemeriksaan jantung & paru</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                        <svg class="w-4 h-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-1">Konsultasi Dokter</h4>
                        <p class="text-sm text-blue-100">Konsultasi dengan spesialis</p>
                    </div>
                </div>
            </div>

            {{-- CTA and Timer --}}
            <div class="flex flex-col lg:flex-row items-center justify-center gap-6">
                {{-- Timer --}}
                <div class="text-center">
                    <div class="text-sm text-yellow-300 mb-2">Promo berakhir dalam:</div>
                    <div class="flex space-x-2 text-lg font-bold">
                        <div class="bg-white bg-opacity-20 rounded-lg px-3 py-3 min-w-[60px] flex flex-col justify-center items-center">
                            <div>07</div>
                            <div class="text-xs">Hari</div>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-lg px-3 py-3 min-w-[60px] flex flex-col justify-center items-center">
                            <div>15</div>
                            <div class="text-xs">Jam</div>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-lg px-3 py-3 min-w-[60px] flex flex-col justify-center items-center">
                            <div>32</div>
                            <div class="text-xs">Menit</div>
                        </div>
                    </div>
                </div>

                {{-- CTA Button --}}
                <div class="flex flex-col items-center">
                    <div class="text-sm text-transparent mb-2">.</div>
                    <a href="{{ route('appointments.create') }}" class="px-8 py-4 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold rounded-lg transition duration-300 inline-flex items-center justify-center h-[52px]">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Daftar Sekarang
                    </a>
                </div>
            </div>
                </a>
            </div>
            </div>

            {{-- Terms --}}
            <p class="text-sm text-blue-200 mt-6">
                *Syarat dan ketentuan berlaku. Promo terbatas hingga 31 Agustus 2025.
            </p>
        </div>
    </div>
</section>
