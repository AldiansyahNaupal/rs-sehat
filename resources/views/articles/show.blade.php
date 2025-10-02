@extends('layouts.app')

@section('title', $article->title . ' - RS Sehat')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary-600">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('articles.index') }}" class="hover:text-primary-600">Artikel</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-800">{{ $article->title }}</span>
        </nav>

        <div class="max-w-4xl mx-auto">
            <!-- Article Header -->
            <header class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <span class="bg-primary-100 text-primary-600 px-4 py-2 rounded-full text-sm font-medium">
                        {{ $article->category }}
                    </span>
                    <div class="flex items-center space-x-4 text-gray-500 text-sm">
                        <span>
                            <i class="fas fa-calendar mr-2"></i>
                            {{ $article->published_at->format('d F Y') }}
                        </span>
                        <span>
                            <i class="fas fa-clock mr-2"></i>
                            {{ $article->reading_time ?? '5' }} menit baca
                        </span>
                    </div>
                </div>
                
                <h1 class="text-4xl font-bold text-gray-800 mb-4 leading-tight">{{ $article->title }}</h1>
                
                @if($article->excerpt)
                <p class="text-xl text-gray-600 leading-relaxed">{{ $article->excerpt }}</p>
                @endif
            </header>

            <!-- Featured Image -->
            @if($article->image)
            <div class="mb-8 rounded-xl overflow-hidden shadow-lg">
                <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-96 object-cover">
            </div>
            @endif

            <!-- Article Content -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <div class="prose prose-lg max-w-none">
                    {!! nl2br(e($article->content)) !!}
                </div>
            </div>

            <!-- Article Tags -->
            @if($article->tags)
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tags:</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $article->tags) as $tag)
                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                        {{ trim($tag) }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Share Article -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Bagikan Artikel</h3>
                <div class="flex items-center space-x-4">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ request()->fullUrl() }}" 
                       target="_blank"
                       class="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                        <span>Facebook</span>
                    </a>
                    
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ request()->fullUrl() }}" 
                       target="_blank"
                       class="flex items-center space-x-2 bg-blue-400 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                        <i class="fab fa-twitter"></i>
                        <span>Twitter</span>
                    </a>
                    
                    <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . request()->fullUrl()) }}" 
                       target="_blank"
                       class="flex items-center space-x-2 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fab fa-whatsapp"></i>
                        <span>WhatsApp</span>
                    </a>
                    
                    <button onclick="copyToClipboard()" 
                            class="flex items-center space-x-2 bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="fas fa-copy"></i>
                        <span>Copy Link</span>
                    </button>
                </div>
            </div>

            <!-- Related Articles -->
            @if($relatedArticles->count() > 0)
            <div class="mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Artikel Terkait</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $related)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        @if($related->image)
                        <img src="{{ $related->image }}" alt="{{ $related->title }}" class="w-full h-40 object-cover">
                        @else
                        <div class="w-full h-40 bg-gradient-to-br from-secondary-400 to-secondary-600 flex items-center justify-center">
                            <i class="fas fa-file-medical-alt text-white text-2xl"></i>
                        </div>
                        @endif
                        
                        <div class="p-4">
                            <span class="bg-secondary-100 text-secondary-700 px-2 py-1 rounded text-xs font-medium">
                                {{ $related->category }}
                            </span>
                            
                            <h4 class="text-lg font-semibold text-gray-800 mt-2 mb-2 line-clamp-2">
                                <a href="{{ route('articles.show', $related) }}" class="hover:text-primary-600 transition-colors">
                                    {{ $related->title }}
                                </a>
                            </h4>
                            
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $related->excerpt }}</p>
                            
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>{{ $related->published_at->format('d M Y') }}</span>
                                <span>{{ $related->reading_time ?? '5' }} min</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Back to Articles -->
            <div class="text-center">
                <a href="{{ route('articles.index') }}" 
                   class="inline-flex items-center bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-700 transition-colors">
                    <i class="fas fa-newspaper mr-2"></i>
                    Kembali ke Artikel
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.prose {
    color: #374151;
    line-height: 1.75;
}

.prose h2 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #1f2937;
}

.prose h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    color: #1f2937;
}

.prose p {
    margin-bottom: 1.25rem;
}

.prose ul, .prose ol {
    margin-bottom: 1.25rem;
    padding-left: 1.5rem;
}

.prose li {
    margin-bottom: 0.5rem;
}

.prose strong {
    font-weight: 600;
    color: #1f2937;
}

.prose em {
    font-style: italic;
}

.prose blockquote {
    border-left: 4px solid #1e90ff;
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #6b7280;
}
</style>

<script>
function copyToClipboard() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        alert('Link artikel berhasil disalin!');
    });
}
</script>
@endsection
