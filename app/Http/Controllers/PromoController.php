<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        // Sample promo data - dalam implementasi nyata bisa dari database
        $promos = collect([
            [
                'id' => 1,
                'title' => 'Paket Medical Check Up Premium',
                'description' => 'Paket pemeriksaan kesehatan lengkap dengan diskon hingga 30%',
                'discount' => '30%',
                'original_price' => 2500000,
                'promo_price' => 1750000,
                'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop',
                'valid_until' => '2024-12-31',
                'category' => 'Medical Check Up',
                'features' => [
                    'Pemeriksaan laboratorium lengkap',
                    'EKG dan foto rontgen',
                    'Konsultasi dokter spesialis',
                    'Laporan hasil digital'
                ]
            ],
            [
                'id' => 2,
                'title' => 'Promo Vaksinasi Keluarga',
                'description' => 'Vaksinasi lengkap untuk satu keluarga dengan harga spesial',
                'discount' => '25%',
                'original_price' => 1200000,
                'promo_price' => 900000,
                'image' => 'https://images.unsplash.com/photo-1584515933487-779824d29309?w=400&h=300&fit=crop',
                'valid_until' => '2024-11-30',
                'category' => 'Vaksinasi',
                'features' => [
                    'Vaksin untuk 4 orang',
                    'Sertifikat vaksinasi',
                    'Monitoring pasca vaksin',
                    'Konsultasi gratis'
                ]
            ],
            [
                'id' => 3,
                'title' => 'Paket Persalinan Normal',
                'description' => 'Paket persalinan normal dengan perawatan terbaik',
                'discount' => '20%',
                'original_price' => 8000000,
                'promo_price' => 6400000,
                'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop',
                'valid_until' => '2024-12-31',
                'category' => 'Persalinan',
                'features' => [
                    'Perawatan ibu dan bayi',
                    'Kamar VIP 3 hari 2 malam',
                    'Konsultasi dokter spesialis',
                    'Pemeriksaan rutin'
                ]
            ],
            [
                'id' => 4,
                'title' => 'Promo Operasi Katarak',
                'description' => 'Operasi katarak dengan teknologi terdepan dan biaya terjangkau',
                'discount' => '35%',
                'original_price' => 15000000,
                'promo_price' => 9750000,
                'image' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=400&h=300&fit=crop',
                'valid_until' => '2024-10-31',
                'category' => 'Operasi',
                'features' => [
                    'Teknologi phacoemulsification',
                    'Lensa premium IOL',
                    'Perawatan pasca operasi',
                    'Garansi hasil operasi'
                ]
            ],
            [
                'id' => 5,
                'title' => 'Paket Dental Care',
                'description' => 'Perawatan gigi lengkap dengan diskon menarik',
                'discount' => '40%',
                'original_price' => 3000000,
                'promo_price' => 1800000,
                'image' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=400&h=300&fit=crop',
                'valid_until' => '2024-11-15',
                'category' => 'Dental',
                'features' => [
                    'Pembersihan karang gigi',
                    'Penambalan gigi',
                    'Konsultasi ortodonti',
                    'Pemeriksaan x-ray dental'
                ]
            ],
            [
                'id' => 6,
                'title' => 'Program Diet Sehat',
                'description' => 'Program diet sehat dengan bimbingan ahli gizi',
                'discount' => '30%',
                'original_price' => 2000000,
                'promo_price' => 1400000,
                'image' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=400&h=300&fit=crop',
                'valid_until' => '2024-12-15',
                'category' => 'Nutrisi',
                'features' => [
                    'Konsultasi ahli gizi',
                    'Menu diet personal',
                    'Monitoring progress',
                    'Supplement premium'
                ]
            ]
        ]);

        return view('promos.index', compact('promos'));
    }

    public function show($id)
    {
        // Sample detail promo - dalam implementasi nyata dari database
        $promo = collect([
            [
                'id' => 1,
                'title' => 'Paket Medical Check Up Premium',
                'description' => 'Paket pemeriksaan kesehatan lengkap dengan diskon hingga 30%. Dapatkan pemeriksaan kesehatan menyeluruh dengan teknologi terdepan dan tim medis berpengalaman.',
                'discount' => '30%',
                'original_price' => 2500000,
                'promo_price' => 1750000,
                'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=800&h=600&fit=crop',
                'valid_until' => '2024-12-31',
                'category' => 'Medical Check Up',
                'features' => [
                    'Pemeriksaan laboratorium lengkap (Darah, Urine, Feses)',
                    'EKG (Elektrokardiogram)',
                    'Foto rontgen thorax',
                    'USG abdomen',
                    'Konsultasi dokter spesialis penyakit dalam',
                    'Konsultasi dokter spesialis jantung',
                    'Laporan hasil digital',
                    'Rekomendasi lifestyle sehat'
                ],
                'terms_conditions' => [
                    'Promo berlaku hingga 31 Desember 2024',
                    'Tidak dapat digabungkan dengan promo lain',
                    'Wajib booking terlebih dahulu',
                    'Berlaku untuk pemeriksaan di hari kerja',
                    'Sudah termasuk biaya konsultasi dokter'
                ]
            ]
        ])->firstWhere('id', (int)$id);

        if (!$promo) {
            abort(404);
        }

        return view('promos.show', compact('promo'));
    }
}
