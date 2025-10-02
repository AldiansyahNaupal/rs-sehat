@extends('layouts.app')

@section('title', 'Artikel Kesehatan - RS Sehat')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Artikel Kesehatan</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Baca artikel terbaru seputar kesehatan, tips medis, dan informasi penting untuk menjaga kesehatan Anda dan keluarga.
            </p>
        </div>

        <!-- Featured Articles Section -->
        @if($featuredArticles->count() > 0)
        <div class="mb-16">
            <h2 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Artikel Unggulan</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($featuredArticles as $article)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    @if($article->image)
                    <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center">
                        <i class="fas fa-newspaper text-white text-4xl"></i>
                    </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="bg-primary-100 text-primary-600 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $article->category }}
                            </span>
                            <span class="text-gray-500 text-sm">
                                {{ $article->published_at->format('d M Y') }}
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-semibold text-gray-800 mb-3 line-clamp-2">
                            <a href="{{ route('articles.show', $article) }}" class="hover:text-primary-600 transition-colors">
                                {{ $article->title }}
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $article->excerpt }}</p>
                        
                        <a href="{{ route('articles.show', $article) }}" 
                           class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium transition-colors">
                            <i class="fas fa-book-open mr-2 text-sm"></i>
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- All Articles Section -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-semibold text-gray-800">Semua Artikel</h2>
                
                <!-- Filter by Category -->
                <div class="flex items-center space-x-4">
                    <select class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="">Semua Kategori</option>
                        <option value="kesehatan-umum">Kesehatan Umum</option>
                        <option value="nutrisi">Nutrisi</option>
                        <option value="olahraga">Olahraga</option>
                        <option value="mental-health">Kesehatan Mental</option>
                        <option value="penyakit">Penyakit</option>
                        <option value="tips-sehat">Tips Sehat</option>
                    </select>
                </div>
            </div>

            <!-- Articles Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
                <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    @if($article->image)
                    <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-secondary-400 to-secondary-600 flex items-center justify-center">
                        <i class="fas fa-file-medical-alt text-white text-4xl"></i>
                    </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="bg-secondary-100 text-secondary-700 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $article->category }}
                            </span>
                            <span class="text-gray-500 text-sm">
                                {{ $article->published_at->format('d M Y') }}
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-semibold text-gray-800 mb-3 line-clamp-2">
                            <a href="{{ route('articles.show', $article) }}" class="hover:text-primary-600 transition-colors">
                                {{ $article->title }}
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $article->excerpt }}</p>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-500 text-sm">
                                <i class="fas fa-clock mr-2"></i>
                                {{ $article->reading_time ?? '5' }} menit baca
                            </div>
                            
                            <a href="{{ route('articles.show', $article) }}" 
                               class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium transition-colors">
                                <i class="fas fa-eye mr-2 text-sm"></i>
                                Baca
                            </a>
                        </div>
                    </div>
                </article>
                @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-newspaper text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Artikel</h3>
                    <p class="text-gray-500">Artikel kesehatan akan segera hadir untuk Anda.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($articles->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $articles->links() }}
            </div>
            @endif
        </div>

        <!-- Newsletter Subscription -->
        <div class="bg-primary-600 rounded-2xl p-8 text-center text-white">
            <h3 class="text-2xl font-semibold mb-4">Dapatkan Artikel Kesehatan Terbaru</h3>
            <p class="text-primary-100 mb-6 max-w-2xl mx-auto">
                Berlangganan newsletter kami untuk mendapatkan tips kesehatan, artikel medis terbaru, dan informasi penting langsung di email Anda.
            </p>
            
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" 
                       placeholder="Masukkan email Anda"
                       class="flex-1 px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-white/20">
                <button type="submit" 
                        class="bg-white text-primary-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Berlangganan
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Custom CSS for line-clamp -->
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
