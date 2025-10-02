{{-- Article Card Component --}}
@props(['article'])

<article class="card group cursor-pointer">
    {{-- Featured Image --}}
    @if($article->featured_image)
        <div class="mb-6 overflow-hidden rounded-lg">
            <img src="{{ $article->featured_image }}" alt="{{ $article->title }}" 
                 class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
        </div>
    @else
        <div class="mb-6 h-48 bg-gradient-to-r from-primary-100 to-secondary-100 rounded-lg flex items-center justify-center">
            <svg class="w-16 h-16 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 011 1v1m0 0l4 4m0 0v10a2 2 0 01-2 2H7m8-14V9a2 2 0 01-2 2H9"></path>
            </svg>
        </div>
    @endif

    {{-- Article Content --}}
    <div>
        {{-- Date and Author --}}
        <div class="flex items-center text-sm text-gray-500 mb-3">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span>{{ $article->published_at ? $article->published_at->format('d M Y') : 'Draft' }}</span>
            
            @if($article->author)
                <span class="mx-2">•</span>
                <span>{{ $article->author }}</span>
            @endif
        </div>

        {{-- Title --}}
        <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-primary-600 transition duration-300 leading-tight">
            {{ $article->title }}
        </h3>

        {{-- Excerpt --}}
        <p class="text-gray-600 mb-4 leading-relaxed">
            {{ $article->excerpt ?: Str::limit(strip_tags($article->content), 150) }}
        </p>

        {{-- Read More Link --}}
        <a href="{{ route('articles.show', $article) }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium transition duration-300">
            <i class="fas fa-book-open mr-2"></i>
            Baca Selengkapnya
        </a>
    </div>
</article>
