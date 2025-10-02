{{-- Navigation Header --}}
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center py-4 px-4 sm:px-6 lg:px-8">
            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-green-500 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">RS Sehat</span>
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center space-x-8">
                <a href="{{ route('doctors.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">
                    Cari Dokter
                </a>
                <a href="{{ route('services.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">
                    Layanan
                </a>
                <a href="{{ route('health-check.index') }}" class="text-gray-700 hover:text-green-600 font-medium transition duration-300 flex items-center">
                    Cek Kesehatan
                </a>
                <a href="{{ route('articles.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">
                    Artikel
                </a>
                <div class="relative group">
                    <button class="text-gray-700 hover:text-blue-600 font-medium transition duration-300 flex items-center">
                        Promo
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    {{-- Dropdown Menu --}}
                    <div class="absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="py-2">
                            <a href="{{ route('promos.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition duration-300">
                                <div class="flex items-center">
                                    <i class="fas fa-tags w-5 mr-3 text-orange-500"></i>
                                    <div>
                                        <div class="font-medium">Semua Promo</div>
                                        <div class="text-xs text-gray-500">Lihat semua penawaran</div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('promos.index') }}?category=Medical+Check+Up" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition duration-300">
                                <div class="flex items-center">
                                    <i class="fas fa-stethoscope w-5 mr-3 text-blue-500"></i>
                                    <div>
                                        <div class="font-medium">Medical Check Up</div>
                                        <div class="text-xs text-gray-500">Paket pemeriksaan kesehatan</div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('promos.index') }}?category=Vaksinasi" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition duration-300">
                                <div class="flex items-center">
                                    <i class="fas fa-syringe w-5 mr-3 text-green-500"></i>
                                    <div>
                                        <div class="font-medium">Vaksinasi</div>
                                        <div class="text-xs text-gray-500">Program vaksinasi</div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('promos.index') }}?category=Dental" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition duration-300">
                                <div class="flex items-center">
                                    <i class="fas fa-tooth w-5 mr-3 text-purple-500"></i>
                                    <div>
                                        <div class="font-medium">Dental Care</div>
                                        <div class="text-xs text-gray-500">Perawatan gigi</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('appointments.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                    <i class="fas fa-calendar-plus mr-2"></i>
                    Buat Janji Temu
                </a>
            </div>

            {{-- Mobile menu button --}}
            <div class="lg:hidden">
                <button class="mobile-menu-button text-gray-700 hover:text-blue-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Navigation --}}
        <div class="mobile-menu hidden lg:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t">
                <a href="{{ route('doctors.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium">
                    Cari Dokter
                </a>
                <a href="{{ route('services.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium">
                    Layanan
                </a>
                <a href="{{ route('health-check.index') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600 font-medium">
                    <!-- <i class="fas fa-heartbeat mr-2 text-green-500"></i> -->
                    Cek Kesehatan
                </a>
                <a href="{{ route('articles.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium">
                    Artikel
                </a>
                <div class="px-3 py-2">
                    <div class="text-gray-700 font-medium mb-2">Promo</div>
                    <div class="pl-4 space-y-1">
                        <a href="{{ route('promos.index') }}" class="block py-2 text-sm text-gray-600 hover:text-blue-600">
                            <i class="fas fa-tags mr-2"></i>Semua Promo
                        </a>
                        <a href="{{ route('promos.index') }}?category=Medical+Check+Up" class="block py-2 text-sm text-gray-600 hover:text-blue-600">
                            <i class="fas fa-stethoscope mr-2"></i>Medical Check Up
                        </a>
                        <a href="{{ route('promos.index') }}?category=Vaksinasi" class="block py-2 text-sm text-gray-600 hover:text-blue-600">
                            <i class="fas fa-syringe mr-2"></i>Vaksinasi
                        </a>
                        <a href="{{ route('promos.index') }}?category=Dental" class="block py-2 text-sm text-gray-600 hover:text-blue-600">
                            <i class="fas fa-tooth mr-2"></i>Dental Care
                        </a>
                    </div>
                </div>
                <a href="{{ route('appointments.create') }}" class="block px-3 py-2 bg-blue-600 text-white rounded-lg font-medium text-center">
                    <i class="fas fa-calendar-plus mr-2"></i>
                    Buat Janji Temu
                </a>
            </div>
        </div>
    </div>
</nav>

{{-- Mobile Menu Toggle Script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const button = document.querySelector('.mobile-menu-button');
    const menu = document.querySelector('.mobile-menu');

    button.addEventListener('click', function() {
        menu.classList.toggle('hidden');
    });
});
</script>
