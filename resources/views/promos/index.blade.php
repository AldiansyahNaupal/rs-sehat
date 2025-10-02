@extends('layouts.app')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-r from-orange-500 to-red-500 text-white py-16">
        <div class="container-custom text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Promo Spesial</h1>
            <p class="text-xl text-orange-100">Dapatkan penawaran terbaik untuk kesehatan Anda dan keluarga</p>
        </div>
    </section>

    {{-- Filter Section --}}
    <section class="py-8 bg-white border-b">
        <div class="container-custom">
            <div class="flex flex-wrap gap-4 justify-center">
                <button class="filter-btn active" data-category="all">
                    <i class="fas fa-th mr-2"></i>
                    Semua Promo
                </button>
                <button class="filter-btn" data-category="Medical Check Up">
                    <i class="fas fa-stethoscope mr-2"></i>
                    Medical Check Up
                </button>
                <button class="filter-btn" data-category="Vaksinasi">
                    <i class="fas fa-syringe mr-2"></i>
                    Vaksinasi
                </button>
                <button class="filter-btn" data-category="Persalinan">
                    <i class="fas fa-baby mr-2"></i>
                    Persalinan
                </button>
                <button class="filter-btn" data-category="Operasi">
                    <i class="fas fa-user-md mr-2"></i>
                    Operasi
                </button>
                <button class="filter-btn" data-category="Dental">
                    <i class="fas fa-tooth mr-2"></i>
                    Dental
                </button>
                <button class="filter-btn" data-category="Nutrisi">
                    <i class="fas fa-apple-alt mr-2"></i>
                    Nutrisi
                </button>
            </div>
        </div>
    </section>

    {{-- Promos Grid Section --}}
    <section class="section-padding bg-gray-50">
        <div class="container-custom">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="promos-container">
                @foreach($promos as $promo)
                    <div class="promo-card card group hover:scale-105 transition duration-300" data-category="{{ $promo['category'] }}">
                        {{-- Promo Image --}}
                        <div class="relative overflow-hidden rounded-t-lg">
                            <img src="{{ $promo['image'] }}" alt="{{ $promo['title'] }}" 
                                 class="w-full h-48 object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute top-4 left-4">
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ $promo['discount'] }} OFF
                                </span>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="bg-white text-gray-700 px-2 py-1 rounded-full text-xs font-medium">
                                    {{ $promo['category'] }}
                                </span>
                            </div>
                        </div>

                        {{-- Promo Content --}}
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition duration-300">
                                {{ $promo['title'] }}
                            </h3>
                            
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                {{ $promo['description'] }}
                            </p>

                            {{-- Pricing --}}
                            <div class="mb-4">
                                <div class="flex items-center space-x-2">
                                    <span class="text-2xl font-bold text-red-500">
                                        Rp {{ number_format($promo['promo_price'], 0, ',', '.') }}
                                    </span>
                                    <span class="text-sm text-gray-500 line-through">
                                        Rp {{ number_format($promo['original_price'], 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-clock mr-1"></i>
                                    Berlaku hingga {{ date('d M Y', strtotime($promo['valid_until'])) }}
                                </div>
                            </div>

                            {{-- Features Preview --}}
                            <div class="mb-6">
                                <ul class="text-sm text-gray-600 space-y-1">
                                    @foreach(array_slice($promo['features'], 0, 3) as $feature)
                                        <li class="flex items-center">
                                            <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                            {{ $feature }}
                                        </li>
                                    @endforeach
                                    @if(count($promo['features']) > 3)
                                        <li class="text-primary-600 font-medium">
                                            +{{ count($promo['features']) - 3 }} benefit lainnya
                                        </li>
                                    @endif
                                </ul>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex flex-col gap-2">
                                <a href="{{ route('promos.show', $promo['id']) }}" 
                                   class="text-primary-600 hover:text-primary-700 font-medium text-sm inline-flex items-center justify-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Lihat Detail Lengkap
                                </a>
                                
                                <a href="{{ route('appointments.create') }}" 
                                   class="btn-primary py-2 px-4 text-sm">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Ambil Promo Ini
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    <section class="section-padding bg-white">
        <div class="container-custom text-center">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    Butuh Konsultasi Sebelum Memilih Promo?
                </h2>
                <p class="text-xl text-gray-600 mb-8">
                    Tim customer service kami siap membantu Anda memilih promo yang paling sesuai dengan kebutuhan.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('appointments.create') }}" class="btn-primary px-8 py-4 text-lg">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Konsultasi Gratis
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

<style>
.filter-btn {
    @apply px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-primary-50 hover:border-primary-500 hover:text-primary-600 transition duration-300;
}

.filter-btn.active {
    @apply bg-primary-500 border-primary-500 text-white;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const promoCards = document.querySelectorAll('.promo-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');

            const category = this.getAttribute('data-category');

            // Filter promo cards
            promoCards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>
