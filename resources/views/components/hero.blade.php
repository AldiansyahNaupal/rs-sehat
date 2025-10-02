{{-- Hero Section --}}
<section class="relative min-h-screen text-white overflow-hidden flex items-center hero-with-bg">
    {{-- Single Background Image --}}
    <div class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat bg-blue-600" 
         style="background-image: url('https://images.unsplash.com/photo-1551190822-a9333d879b1f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    </div>
    
    {{-- Gradient Overlay for better text readability --}}
    <div class="absolute inset-0 z-10 bg-gradient-to-br from-blue-900/85 via-blue-800/75 to-green-800/80"></div>
    
    <div class="relative max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8 z-20">
        <div class="text-center max-w-4xl mx-auto">
            {{-- Main Heading with enhanced styling --}}
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight drop-shadow-lg">
                Yang Berarti, 
                <span class="text-yellow-300 drop-shadow-md">Segera Kembali</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-blue-100 drop-shadow-md leading-relaxed">
                Kesehatan Anda adalah prioritas utama kami. Dapatkan pelayanan terbaik dari tim medis berpengalaman dengan teknologi modern dan fasilitas terdepan.
            </p>

            {{-- Simple Search Bar --}}
            <div class="max-w-2xl mx-auto mb-12 relative z-20">
                <form action="{{ route('doctors.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1 relative">
                        <input 
                            type="text" 
                            name="search" 
                            id="search-input"
                            placeholder="Cari dokter, spesialisasi, atau layanan..."
                            class="w-full px-6 py-4 pr-12 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-400 shadow-lg"
                            value="{{ request('search') }}"
                        />
                        <button 
                            type="button" 
                            id="clear-search"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition duration-200 {{ request('search') ? '' : 'hidden' }}"
                            onclick="clearSearch()"
                        >
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                    <button type="submit" class="px-8 py-4 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold rounded-lg transition duration-300 flex items-center justify-center shadow-lg">
                        <i class="fas fa-search mr-2"></i>
                        Cari Sekarang
                    </button>
                </form>
            </div>

            {{-- Simple CTA Buttons --}}
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="{{ route('appointments.create') }}" class="px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition duration-300 shadow-lg inline-flex items-center justify-center">
                    <i class="fas fa-calendar-plus mr-3"></i>
                    Buat Janji Temu
                </a>
                <a href="{{ route('services.index') }}" class="px-8 py-4 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-blue-600 transition duration-300 inline-flex items-center justify-center">
                    <i class="fas fa-hospital-alt mr-3"></i>
                    Lihat Layanan
                </a>
            </div>
        </div>
    </div>
</section>

<script>
// Simple clear search functionality
function clearSearch() {
    const searchInput = document.getElementById('search-input');
    const clearButton = document.getElementById('clear-search');
    
    searchInput.value = '';
    clearButton.classList.add('hidden');
    searchInput.focus();
}

// Show/hide clear button based on input value
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const clearButton = document.getElementById('clear-search');
    
    if (searchInput && clearButton) {
        searchInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                clearButton.classList.remove('hidden');
            } else {
                clearButton.classList.add('hidden');
            }
        });
    }
});
</script>

<style>
.hero-with-bg {
    background: linear-gradient(to right, #2563eb, #059669);
}

.hero-with-bg > div:first-child {
    background-image: url('https://images.unsplash.com/photo-1551190822-a9333d879b1f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') !important;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    min-height: 100vh;
}

/* Fallback untuk memastikan background muncul */
@media (min-width: 1px) {
    .hero-with-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('https://images.unsplash.com/photo-1551190822-a9333d879b1f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        z-index: 1;
    }
    
    .hero-with-bg > div:last-child {
        z-index: 30 !important;
        position: relative;
    }
}
</style>
