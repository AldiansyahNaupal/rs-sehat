{{-- Service Card Component --}}
@props(['service'])

<div class="card group cursor-pointer">
    {{-- Service Icon/Image --}}
    <div class="text-center mb-6">
        @if($service->image)
            <img src="{{ $service->image }}" alt="{{ $service->name }}" class="w-16 h-16 mx-auto rounded-lg object-cover">
        @else
            <div class="w-16 h-16 bg-gradient-to-r from-primary-600 to-secondary-500 rounded-lg flex items-center justify-center mx-auto">
                @if($service->icon)
                    <i class="{{ $service->icon }} text-2xl text-white"></i>
                @else
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                @endif
            </div>
        @endif
    </div>

    {{-- Service Info --}}
    <div class="text-center">
        <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-primary-600 transition duration-300">
            {{ $service->name }}
        </h3>
        <p class="text-gray-600 mb-4 leading-relaxed">
            {{ Str::limit($service->description, 120) }}
        </p>
        
        @if($service->price)
            <div class="text-lg font-semibold text-primary-600 mb-4">
                Mulai dari Rp {{ number_format($service->price, 0, ',', '.') }}
            </div>
        @endif

        <a href="{{ route('services.show', $service) }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium transition duration-300">
            Pelajari Lebih Lanjut
            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </a>
    </div>
</div>
