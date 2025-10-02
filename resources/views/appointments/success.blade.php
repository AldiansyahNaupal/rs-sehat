@extends('layouts.app')

@section('content')
    <section class="section-padding bg-gray-50 min-h-screen flex items-center">
        <div class="container-custom">
            <div class="max-w-2xl mx-auto text-center">
                {{-- Success Icon --}}
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                {{-- Success Message --}}
                <h1 class="text-4xl font-bold text-gray-900 mb-6">
                    Janji Temu Berhasil Dibuat!
                </h1>
                
                <p class="text-xl text-gray-600 mb-8">
                    Terima kasih telah mempercayakan kesehatan Anda kepada kami. 
                    Kami telah mengirim konfirmasi ke email dan WhatsApp Anda.
                </p>

                {{-- Notification Status --}}
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-green-800 mb-4 flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        Notifikasi Telah Dikirim
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="flex items-center text-green-700">
                            <i class="fas fa-envelope mr-3 text-green-600"></i>
                            <span>Email konfirmasi dikirim ke kotak masuk Anda</span>
                        </div>
                        <div class="flex items-center text-green-700">
                            <i class="fab fa-whatsapp mr-3 text-green-600"></i>
                            <span>Pesan WhatsApp dikirim ke nomor Anda</span>
                        </div>
                    </div>
                    <p class="text-green-600 text-xs mt-3">
                        <i class="fas fa-info-circle mr-1"></i>
                        Periksa folder spam jika email tidak masuk dalam 5 menit
                    </p>
                </div>

                {{-- Next Steps --}}
                <div class="bg-white rounded-xl shadow-md p-8 mb-8 text-left">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Langkah Selanjutnya</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center flex-shrink-0 font-semibold">
                                1
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Konfirmasi via Telepon</h3>
                                <p class="text-gray-600">Tim kami akan menghubungi Anda dalam 2-4 jam untuk mengonfirmasi jadwal dan memberikan instruksi persiapan.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center flex-shrink-0 font-semibold">
                                2
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Persiapan Kunjungan</h3>
                                <p class="text-gray-600">Siapkan dokumen identitas, kartu asuransi (jika ada), dan catatan riwayat kesehatan Anda.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center flex-shrink-0 font-semibold">
                                3
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Datang Tepat Waktu</h3>
                                <p class="text-gray-600">Harap datang 15 menit sebelum jadwal untuk proses administrasi.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Important Notes --}}
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8 text-left">
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-yellow-800 mb-2">Catatan Penting</h3>
                            <ul class="text-yellow-700 space-y-1">
                                <li>• Jika perlu membatalkan atau mengubah jadwal, hubungi kami minimal 24 jam sebelumnya</li>
                                <li>• Bawa kartu identitas dan kartu asuransi kesehatan</li>
                                <li>• Untuk pemeriksaan laboratorium, mungkin diperlukan puasa sebelumnya</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}" class="btn-primary px-8 py-4 text-lg">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Beranda
                    </a>
                    
                    <a href="tel:(021)123-4567" class="btn-secondary px-8 py-4 text-lg">
                        <i class="fas fa-phone mr-2"></i>
                        Hubungi Kami
                    </a>
                </div>

                {{-- Contact Info --}}
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Butuh Bantuan?</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600">
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>(021) 123-4567</span>
                        </div>
                        
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>info@rssehat.com</span>
                        </div>
                        
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span>WhatsApp: 08123456789</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
