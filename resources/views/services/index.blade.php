@extends('layouts.app')

@section('title', 'Layanan Medis - RS Sehat')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Layanan Medis Kami</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                RS Sehat menyediakan layanan medis komprehensif dengan teknologi terdepan dan tim medis berpengalaman untuk memberikan perawatan terbaik bagi Anda dan keluarga.
            </p>
        </div>

        <!-- Search & Filter Section -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-12">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Cari layanan medis..." 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
                
                <div class="flex gap-4">
                    <select class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="">Semua Kategori</option>
                        <option value="spesialis">Spesialis</option>
                        <option value="umum">Umum</option>
                        <option value="penunjang">Penunjang</option>
                        <option value="darurat">Darurat</option>
                    </select>
                    
                    <select class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="">Urutkan</option>
                        <option value="name">Nama A-Z</option>
                        <option value="price_low">Harga Terendah</option>
                        <option value="price_high">Harga Tertinggi</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Services Statistics -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-xl shadow-md p-6 text-center">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-md text-primary-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800">{{ $services->where('name', 'like', '%Spesialis%')->count() }}+</h3>
                <p class="text-gray-600">Layanan Spesialis</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6 text-center">
                <div class="w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-stethoscope text-secondary-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800">24/7</h3>
                <p class="text-gray-600">Layanan Darurat</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6 text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-hospital text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800">{{ $services->count() }}+</h3>
                <p class="text-gray-600">Total Layanan</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-award text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800">ISO</h3>
                <p class="text-gray-600">Standar Kualitas</p>
            </div>
        </div>

        <!-- Services Grid -->
        <div class="mb-12">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $service)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
                    <!-- Service Icon/Image -->
                    <div class="h-48 bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center relative overflow-hidden">
                        <i class="{{ $service->icon ?? 'fas fa-hospital' }} text-white text-5xl group-hover:scale-110 transition-transform duration-300"></i>
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    </div>
                    
                    <div class="p-6">
                        <!-- Service Header -->
                        <div class="flex items-center justify-between mb-3">
                            <span class="bg-primary-100 text-primary-600 px-3 py-1 rounded-full text-sm font-medium">
                                @if(str_contains($service->name, 'Spesialis'))
                                    Spesialis
                                @elseif(str_contains($service->name, 'Check Up'))
                                    Medical Check Up
                                @elseif(in_array($service->name, ['Laboratorium', 'Radiologi']))
                                    Penunjang
                                @else
                                    Umum
                                @endif
                            </span>
                            
                            @if($service->price)
                            <span class="text-primary-600 font-semibold">
                                Rp {{ number_format($service->price, 0, ',', '.') }}
                            </span>
                            @endif
                        </div>
                        
                        <!-- Service Title -->
                        <h3 class="text-xl font-semibold text-gray-800 mb-3 group-hover:text-primary-600 transition-colors">
                            <a href="{{ route('services.show', $service) }}">{{ $service->name }}</a>
                        </h3>
                        
                        <!-- Service Description -->
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $service->description }}</p>
                        
                        <!-- Service Features -->
                        <div class="mb-4">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <i class="fas fa-clock mr-2 text-primary-500"></i>
                                <span>Tersedia setiap hari</span>
                            </div>
                            @if($service->price)
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-tag mr-2 text-secondary-500"></i>
                                <span>Harga terjangkau</span>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <a href="{{ route('services.show', $service) }}" 
                               class="flex-1 bg-primary-600 text-white text-center py-2 px-4 rounded-lg hover:bg-primary-700 transition-colors font-medium">
                                <i class="fas fa-info-circle mr-2"></i>
                                Detail Layanan
                            </a>
                            <a href="{{ route('appointments.create', ['service_id' => $service->id]) }}" 
                               class="flex-1 border border-primary-600 text-primary-600 text-center py-2 px-4 rounded-lg hover:bg-primary-50 transition-colors font-medium">
                                <i class="fas fa-calendar-plus mr-2"></i>
                                Buat Janji
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-hospital text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Layanan</h3>
                    <p class="text-gray-500">Layanan medis akan segera tersedia untuk Anda.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($services->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $services->links() }}
            </div>
            @endif
        </div>

        <!-- Why Choose Our Services -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-12">
            <h2 class="text-3xl font-semibold text-gray-800 text-center mb-8">Mengapa Memilih Layanan Kami?</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-medal text-primary-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Dokter Berpengalaman</h3>
                    <p class="text-gray-600">Tim medis profesional dengan pengalaman bertahun-tahun dan sertifikasi internasional.</p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-microscope text-secondary-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Teknologi Terdepan</h3>
                    <p class="text-gray-600">Peralatan medis canggih dan teknologi terbaru untuk diagnosis yang akurat.</p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-heart text-blue-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Pelayanan Terbaik</h3>
                    <p class="text-gray-600">Komitmen memberikan pelayanan terbaik dengan perhatian penuh kepada setiap pasien.</p>
                </div>
            </div>
        </div>

        <!-- Emergency Contact -->
        <div class="bg-red-600 rounded-2xl p-8 text-center text-white">
            <div class="flex items-center justify-center mb-4">
                <i class="fas fa-ambulance text-4xl mr-4"></i>
                <h3 class="text-2xl font-semibold">Layanan Gawat Darurat 24/7</h3>
            </div>
            <p class="text-red-100 mb-6 max-w-2xl mx-auto">
                Dalam situasi darurat medis, hubungi nomor emergency kami yang tersedia 24 jam setiap hari.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="tel:119" 
                   class="bg-white text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors inline-flex items-center justify-center">
                    <i class="fas fa-phone mr-2"></i>
                    119 (Emergency)
                </a>
                <a href="tel:+62211234567" 
                   class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-red-600 transition-colors inline-flex items-center justify-center">
                    <i class="fas fa-hospital mr-2"></i>
                    (021) 1234-567
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
