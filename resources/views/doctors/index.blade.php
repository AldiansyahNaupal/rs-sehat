@extends('layouts.app')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-r from-primary-600 to-secondary-500 text-white py-16">
        <div class="container-custom text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Dokter Spesialis</h1>
            <p class="text-xl text-blue-100">Tim dokter berpengalaman siap melayani kebutuhan kesehatan Anda</p>
        </div>
    </section>

    {{-- Search and Filter Section --}}
    <section class="py-8 bg-white border-b">
        <div class="container-custom">
            <form action="{{ route('doctors.index') }}" method="GET" class="flex flex-col lg:flex-row gap-4">
                {{-- Search Input --}}
                <div class="flex-1 relative">
                    <input type="text" name="search" 
                           id="doctors-search-input"
                           placeholder="Cari nama dokter..." 
                           value="{{ request('search') }}"
                           class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-300">
                    <button 
                        type="button" 
                        id="doctors-clear-search"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition duration-200 {{ request('search') ? '' : 'hidden' }}"
                        onclick="clearDoctorsSearch()"
                    >
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                {{-- Specialization Filter --}}
                <div class="lg:w-64">
                    <select name="specialization" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-300">
                        <option value="">Semua Spesialisasi</option>
                        @foreach($specializations as $specialization)
                            <option value="{{ $specialization }}" {{ request('specialization') == $specialization ? 'selected' : '' }}>
                                {{ $specialization }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Search Button --}}
                <button type="submit" class="btn-primary px-8 py-3 lg:w-auto">
                    <i class="fas fa-search mr-2"></i>
                    Cari
                </button>
            </form>
        </div>
    </section>

    {{-- Doctors Grid Section --}}
    <section class="section-padding bg-gray-50">
        <div class="container-custom">
            @if($doctors->count() > 0)
                {{-- Results Info --}}
                <div class="mb-8">
                    <p class="text-gray-600">
                        Menampilkan {{ $doctors->firstItem() }}-{{ $doctors->lastItem() }} dari {{ $doctors->total() }} dokter
                        @if(request('search'))
                            untuk pencarian "{{ request('search') }}"
                        @endif
                        @if(request('specialization'))
                            dengan spesialisasi "{{ request('specialization') }}"
                        @endif
                    </p>
                </div>

                {{-- Doctors Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
                    @foreach($doctors as $doctor)
                        <div class="card text-center group hover:scale-105 transition duration-300">
                            {{-- Doctor Photo --}}
                            <div class="mb-6">
                                @if($doctor->photo)
                                    <img src="{{ $doctor->photo }}" alt="Dr. {{ $doctor->name }}" 
                                         class="w-24 h-24 rounded-full mx-auto object-cover border-4 border-primary-100">
                                @else
                                    <div class="w-24 h-24 bg-gradient-to-r from-primary-600 to-secondary-500 rounded-full flex items-center justify-center mx-auto border-4 border-primary-100">
                                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Doctor Info --}}
                            <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-primary-600 transition duration-300">
                                Dr. {{ $doctor->name }}
                            </h3>
                            
                            <div class="text-primary-600 font-medium mb-3 bg-primary-50 inline-block px-3 py-1 rounded-full text-sm">
                                {{ $doctor->specialization }}
                            </div>
                            
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                {{ Str::limit($doctor->description, 100) }}
                            </p>

                            @if($doctor->experience)
                                <div class="text-sm text-gray-500 mb-4">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $doctor->experience }}
                                </div>
                            @endif

                            {{-- Action Buttons --}}
                            <div class="flex flex-col gap-2">
                                <a href="{{ route('doctors.show', $doctor) }}" 
                                   class="text-primary-600 hover:text-primary-700 font-medium text-sm inline-flex items-center justify-center">
                                    <i class="fas fa-user-md mr-2"></i>
                                    Lihat Profil Lengkap
                                </a>
                                
                                <a href="{{ route('appointments.create', ['doctor_id' => $doctor->id]) }}" 
                                   class="btn-primary py-2 px-4 text-sm">
                                    <i class="fas fa-calendar-plus mr-2"></i>
                                    Buat Janji Temu
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="flex justify-center">
                    {{ $doctors->appends(request()->query())->links() }}
                </div>

            @else
                {{-- No Results --}}
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">Dokter Tidak Ditemukan</h3>
                    <p class="text-gray-600 mb-8">
                        @if(request()->hasAny(['search', 'specialization']))
                            Maaf, tidak ada dokter yang sesuai dengan kriteria pencarian Anda.
                        @else
                            Saat ini belum ada data dokter yang tersedia.
                        @endif
                    </p>
                    
                    @if(request()->hasAny(['search', 'specialization']))
                        <a href="{{ route('doctors.index') }}" class="btn-primary">
                            Lihat Semua Dokter
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    {{-- Call to Action --}}
    <section class="section-padding bg-white">
        <div class="container-custom text-center">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    Tidak Menemukan Dokter yang Dicari?
                </h2>
                <p class="text-xl text-gray-600 mb-8">
                    Hubungi customer service kami untuk bantuan memilih dokter yang tepat sesuai kebutuhan Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('appointments.create') }}" class="btn-primary px-8 py-4 text-lg">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Buat Janji Temu
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

<script>
function clearDoctorsSearch() {
    const searchInput = document.getElementById('doctors-search-input');
    const clearButton = document.getElementById('doctors-clear-search');
    
    searchInput.value = '';
    clearButton.classList.add('hidden');
    searchInput.focus();
}

// Show/hide clear button based on input value
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('doctors-search-input');
    const clearButton = document.getElementById('doctors-clear-search');
    
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
