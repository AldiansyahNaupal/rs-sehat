@extends('layouts.app')

@section('content')
    {{-- Breadcrumb --}}
    <section class="bg-gray-100 py-4">
        <div class="container-custom">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600">
                            <i class="fas fa-home mr-2"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="{{ route('promos.index') }}" class="text-gray-700 hover:text-primary-600">Promo</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="text-gray-500">{{ $promo['title'] }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    {{-- Promo Detail --}}
    <section class="section-padding bg-white">
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                {{-- Promo Image --}}
                <div class="space-y-6">
                    <div class="relative overflow-hidden rounded-lg shadow-lg">
                        <img src="{{ $promo['image'] }}" alt="{{ $promo['title'] }}" 
                             class="w-full h-96 object-cover">
                        <div class="absolute top-6 left-6">
                            <span class="bg-red-500 text-white px-4 py-2 rounded-full text-lg font-bold shadow-lg">
                                <i class="fas fa-tag mr-2"></i>
                                {{ $promo['discount'] }} OFF
                            </span>
                        </div>
                        <div class="absolute top-6 right-6">
                            <span class="bg-white text-gray-700 px-3 py-2 rounded-full text-sm font-medium shadow-lg">
                                {{ $promo['category'] }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Promo Information --}}
                <div class="space-y-6">
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                            {{ $promo['title'] }}
                        </h1>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            {{ $promo['description'] }}
                        </p>
                    </div>

                    {{-- Pricing Card --}}
                    <div class="bg-gradient-to-r from-red-50 to-orange-50 p-6 rounded-lg border border-red-200">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-3xl font-bold text-red-600">
                                    Rp {{ number_format($promo['promo_price'], 0, ',', '.') }}
                                </span>
                                <span class="text-lg text-gray-500 line-through ml-3">
                                    Rp {{ number_format($promo['original_price'], 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-600">Hemat</div>
                                <div class="text-xl font-bold text-green-600">
                                    Rp {{ number_format($promo['original_price'] - $promo['promo_price'], 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-clock mr-2 text-red-500"></i>
                            Promo berlaku hingga {{ date('d F Y', strtotime($promo['valid_until'])) }}
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('appointments.create') }}" 
                           class="btn-primary flex-1 py-4 text-lg justify-center">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Ambil Promo Sekarang
                        </a>
                        <a href="tel:(021)123-4567" 
                           class="btn-secondary flex-1 py-4 text-lg justify-center">
                            <i class="fas fa-phone mr-2"></i>
                            Tanya Detail
                        </a>
                    </div>

                    {{-- Share Buttons --}}
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Bagikan Promo</h3>
                        <div class="flex space-x-3">
                            <a href="https://wa.me/?text=Lihat promo menarik ini: {{ urlencode($promo['title']) }} - {{ urlencode(request()->url()) }}" 
                               target="_blank"
                               class="bg-green-500 hover:bg-green-600 text-white p-3 rounded-full transition duration-300">
                                <i class="fab fa-whatsapp text-lg"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank"
                               class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition duration-300">
                                <i class="fab fa-facebook-f text-lg"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($promo['title']) }}&url={{ urlencode(request()->url()) }}" 
                               target="_blank"
                               class="bg-blue-400 hover:bg-blue-500 text-white p-3 rounded-full transition duration-300">
                                <i class="fab fa-twitter text-lg"></i>
                            </a>
                            <button onclick="copyToClipboard()" 
                                    class="bg-gray-600 hover:bg-gray-700 text-white p-3 rounded-full transition duration-300">
                                <i class="fas fa-copy text-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features & Benefits --}}
    <section class="section-padding bg-gray-50">
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                {{-- Features --}}
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-star text-yellow-500 mr-2"></i>
                        Yang Anda Dapatkan
                    </h2>
                    <div class="space-y-4">
                        @foreach($promo['features'] as $feature)
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                </div>
                                <p class="text-gray-700">{{ $feature }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Terms & Conditions --}}
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-file-contract text-blue-500 mr-2"></i>
                        Syarat & Ketentuan
                    </h2>
                    <div class="space-y-3">
                        @foreach($promo['terms_conditions'] as $term)
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                                </div>
                                <p class="text-gray-700 text-sm">{{ $term }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Promos --}}
    <section class="section-padding bg-white">
        <div class="container-custom">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Promo Lainnya</h2>
                <p class="text-xl text-gray-600">Lihat penawaran menarik lainnya untuk kesehatan Anda</p>
            </div>
            
            <div class="text-center">
                <a href="{{ route('promos.index') }}" class="btn-primary px-8 py-4 text-lg">
                    <i class="fas fa-tags mr-2"></i>
                    Lihat Semua Promo
                </a>
            </div>
        </div>
    </section>
@endsection

<script>
function copyToClipboard() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        alert('Link berhasil disalin!');
    }, function(err) {
        console.error('Gagal menyalin link: ', err);
    });
}
</script>
