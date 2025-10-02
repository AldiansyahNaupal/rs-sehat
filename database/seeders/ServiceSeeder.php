<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Medical Check Up Komprehensif',
                'description' => 'Pemeriksaan kesehatan menyeluruh meliputi pemeriksaan fisik, laboratorium lengkap, EKG, foto rontgen, dan konsultasi dengan dokter spesialis.',
                'icon' => 'fas fa-user-md',
                'price' => 1500000,
                'is_active' => true,
            ],
            [
                'name' => 'Konsultasi Dokter Spesialis',
                'description' => 'Konsultasi dengan dokter spesialis sesuai keluhan dan kebutuhan kesehatan Anda dengan teknologi modern.',
                'icon' => 'fas fa-stethoscope',
                'price' => 250000,
                'is_active' => true,
            ],
            [
                'name' => 'Laboratorium Klinik',
                'description' => 'Pemeriksaan laboratorium lengkap dengan teknologi terkini untuk mendukung diagnosis yang akurat.',
                'icon' => 'fas fa-flask',
                'price' => 150000,
                'is_active' => true,
            ],
            [
                'name' => 'Radiologi & Imaging',
                'description' => 'Layanan pemeriksaan radiologi meliputi foto rontgen, CT scan, MRI, dan USG dengan teknologi canggih.',
                'icon' => 'fas fa-x-ray',
                'price' => 400000,
                'is_active' => true,
            ],
            [
                'name' => 'Rawat Inap',
                'description' => 'Fasilitas rawat inap dengan berbagai kelas ruangan dan perawatan 24 jam oleh tenaga medis berpengalaman.',
                'icon' => 'fas fa-bed',
                'price' => 800000,
                'is_active' => true,
            ],
            [
                'name' => 'Instalasi Gawat Darurat',
                'description' => 'Layanan emergency 24 jam dengan tim medis siaga dan peralatan lengkap untuk penanganan kasus darurat.',
                'icon' => 'fas fa-ambulance',
                'price' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Bedah Umum',
                'description' => 'Layanan bedah dengan teknologi minimal invasif dan tim ahli bedah berpengalaman.',
                'icon' => 'fas fa-user-nurse',
                'price' => 5000000,
                'is_active' => true,
            ],
            [
                'name' => 'Fisioterapi',
                'description' => 'Terapi rehabilitasi untuk pemulihan fungsi tubuh pasca cedera atau operasi dengan terapis berpengalaman.',
                'icon' => 'fas fa-dumbbell',
                'price' => 200000,
                'is_active' => true,
            ],
            [
                'name' => 'Hemodialisis',
                'description' => 'Layanan cuci darah untuk pasien gagal ginjal dengan mesin modern dan perawatan komprehensif.',
                'icon' => 'fas fa-tint',
                'price' => 600000,
                'is_active' => true,
            ],
            [
                'name' => 'Kemoterapi',
                'description' => 'Terapi kanker dengan protokol terkini dan perawatan holistik oleh tim onkologi berpengalaman.',
                'icon' => 'fas fa-ribbon',
                'price' => 3000000,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
