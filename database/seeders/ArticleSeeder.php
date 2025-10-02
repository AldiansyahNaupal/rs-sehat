<?php

namespace Database\Seeders;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => '10 Tips Menjaga Kesehatan Jantung di Era Modern',
                'content' => '<p>Kesehatan jantung merupakan aspek vital dalam menjaga kualitas hidup. Di era modern ini, gaya hidup yang serba cepat seringkali membuat kita mengabaikan kesehatan jantung...</p><p>Berikut adalah 10 tips praktis untuk menjaga kesehatan jantung Anda:</p><ol><li>Konsumsi makanan bergizi seimbang</li><li>Olahraga teratur minimal 30 menit per hari</li><li>Hindari merokok dan alkohol berlebihan</li><li>Kelola stress dengan baik</li><li>Istirahat yang cukup 7-8 jam per hari</li></ol>',
                'excerpt' => 'Pelajari 10 tips praktis untuk menjaga kesehatan jantung Anda di tengah kesibukan era modern. Mulai dari pola makan hingga manajemen stress.',
                'author' => 'Dr. Ahmad Wijaya, Sp.JP',
                'published_at' => Carbon::now()->subDays(2),
                'is_published' => true,
            ],
            [
                'title' => 'Pentingnya Vaksinasi untuk Anak-Anak',
                'content' => '<p>Vaksinasi merupakan salah satu cara paling efektif untuk melindungi anak dari berbagai penyakit berbahaya. Program imunisasi yang lengkap dapat mencegah penyebaran penyakit dan melindungi kesehatan masyarakat secara keseluruhan...</p><p>Jadwal vaksinasi yang direkomendasikan oleh Ikatan Dokter Anak Indonesia (IDAI) meliputi:</p><ul><li>Vaksin Hepatitis B</li><li>Vaksin BCG</li><li>Vaksin DPT</li><li>Vaksin Polio</li><li>Vaksin Campak</li></ul>',
                'excerpt' => 'Memahami pentingnya vaksinasi dalam melindungi anak dari penyakit berbahaya dan jadwal imunisasi yang direkomendasikan.',
                'author' => 'Dr. Rizki Pratama, Sp.A',
                'published_at' => Carbon::now()->subDays(5),
                'is_published' => true,
            ],
            [
                'title' => 'Cara Mengatasi Stress dan Kecemasan di Tempat Kerja',
                'content' => '<p>Stress dan kecemasan di tempat kerja telah menjadi masalah umum yang dialami banyak pekerja. Jika tidak ditangani dengan baik, kondisi ini dapat berdampak negatif pada kesehatan mental dan fisik...</p><p>Beberapa strategi efektif untuk mengatasi stress di tempat kerja:</p><ol><li>Atur prioritas dan buat jadwal yang realistis</li><li>Lakukan teknik pernapasan dan meditasi</li><li>Ambil istirahat secara teratur</li><li>Komunikasikan masalah dengan atasan atau rekan kerja</li><li>Jaga keseimbangan work-life balance</li></ol>',
                'excerpt' => 'Strategi praktis untuk mengatasi stress dan kecemasan di tempat kerja demi menjaga kesehatan mental dan produktivitas.',
                'author' => 'Dr. Nadia Fitriani, Sp.KJ',
                'published_at' => Carbon::now()->subDays(7),
                'is_published' => true,
            ],
            [
                'title' => 'Deteksi Dini Kanker: Pentingnya Screening Rutin',
                'content' => '<p>Deteksi dini kanker sangat penting untuk meningkatkan peluang kesembuhan. Semakin cepat kanker terdeteksi, semakin efektif pengobatan yang dapat diberikan...</p><p>Jenis screening yang direkomendasikan:</p><ul><li>Mammografi untuk kanker payudara</li><li>Pap smear untuk kanker serviks</li><li>Kolonoskopi untuk kanker usus besar</li><li>PSA test untuk kanker prostat</li></ul><p>Konsultasikan dengan dokter mengenai jadwal screening yang sesuai dengan usia dan faktor risiko Anda.</p>',
                'excerpt' => 'Pentingnya melakukan screening rutin untuk deteksi dini kanker dan jenis pemeriksaan yang direkomendasikan sesuai usia.',
                'author' => 'Dr. Maya Kusuma, Sp.OG',
                'published_at' => Carbon::now()->subDays(10),
                'is_published' => true,
            ],
            [
                'title' => 'Manfaat Olahraga Rutin untuk Kesehatan Tulang',
                'content' => '<p>Olahraga rutin tidak hanya baik untuk kesehatan jantung dan berat badan, tetapi juga sangat penting untuk menjaga kesehatan tulang. Aktivitas fisik yang tepat dapat membantu mencegah osteoporosis...</p><p>Jenis olahraga yang baik untuk tulang:</p><ol><li>Weight bearing exercises (berlari, jalan cepat)</li><li>Resistance training (angkat beban)</li><li>Yoga dan pilates</li><li>Senam aerobik</li></ol><p>Mulai dengan intensitas ringan dan tingkatkan secara bertahap sesuai kemampuan tubuh.</p>',
                'excerpt' => 'Pelajari berbagai jenis olahraga yang efektif untuk menjaga kesehatan tulang dan mencegah osteoporosis.',
                'author' => 'Dr. Budi Santoso, Sp.OT',
                'published_at' => Carbon::now()->subDays(14),
                'is_published' => true,
            ],
            [
                'title' => 'Menjaga Kesehatan Mata di Era Digital',
                'content' => '<p>Penggunaan gadget dan komputer yang berlebihan dapat menyebabkan Computer Vision Syndrome (CVS). Gejala yang sering muncul antara lain mata kering, lelah, dan penglihatan kabur...</p><p>Tips menjaga kesehatan mata:</p><ul><li>Terapkan aturan 20-20-20 (setiap 20 menit, lihat objek sejauh 20 kaki selama 20 detik)</li><li>Atur pencahayaan ruangan dengan baik</li><li>Gunakan filter blue light</li><li>Konsumsi makanan kaya vitamin A</li><li>Rutin periksa mata ke dokter</li></ul>',
                'excerpt' => 'Tips praktis untuk menjaga kesehatan mata di era digital dan mencegah Computer Vision Syndrome.',
                'author' => 'Dr. Lestari Wulandari, Sp.M',
                'published_at' => Carbon::now()->subDays(18),
                'is_published' => true,
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
