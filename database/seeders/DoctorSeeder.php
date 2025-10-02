<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            [
                'name' => 'Ahmad Wijaya',
                'specialization' => 'Kardiologi',
                'description' => 'Spesialis jantung dan pembuluh darah dengan pengalaman 15 tahun. Ahli dalam penanganan penyakit jantung koroner, hipertensi, dan gagal jantung.',
                'education' => 'S1 FK UI, Sp.JP FKUI',
                'experience' => '15 tahun pengalaman',
                'is_active' => true,
            ],
            [
                'name' => 'Sari Indrawati',
                'specialization' => 'Neurologi',
                'description' => 'Dokter spesialis saraf yang berpengalaman menangani stroke, epilepsi, dan gangguan neurologis lainnya.',
                'education' => 'S1 FK UNPAD, Sp.S FKUI',
                'experience' => '12 tahun pengalaman',
                'is_active' => true,
            ],
            [
                'name' => 'Budi Santoso',
                'specialization' => 'Orthopedi',
                'description' => 'Spesialis tulang dan sendi dengan keahlian dalam bedah tulang belakang dan penggantian sendi.',
                'education' => 'S1 FK UGM, Sp.OT FKUI',
                'experience' => '18 tahun pengalaman',
                'is_active' => true,
            ],
            [
                'name' => 'Maya Kusuma',
                'specialization' => 'Obstetri & Ginekologi',
                'description' => 'Dokter spesialis kandungan dan kebidanan yang menangani kehamilan, persalinan, dan masalah reproduksi wanita.',
                'education' => 'S1 FK UNAIR, Sp.OG FKUI',
                'experience' => '10 tahun pengalaman',
                'is_active' => true,
            ],
            [
                'name' => 'Rizki Pratama',
                'specialization' => 'Pediatri',
                'description' => 'Dokter spesialis anak yang berpengalaman menangani tumbuh kembang anak dan penyakit pada bayi dan anak.',
                'education' => 'S1 FK UNDIP, Sp.A FKUI',
                'experience' => '8 tahun pengalaman',
                'is_active' => true,
            ],
            [
                'name' => 'Dewi Permata',
                'specialization' => 'Dermatologi',
                'description' => 'Spesialis kulit dan kelamin dengan keahlian dalam perawatan estetika dan pengobatan penyakit kulit.',
                'education' => 'S1 FK USU, Sp.KK FKUI',
                'experience' => '9 tahun pengalaman',
                'is_active' => true,
            ],
            [
                'name' => 'Hendra Gunawan',
                'specialization' => 'Pulmonologi',
                'description' => 'Dokter spesialis paru yang menangani asma, PPOK, pneumonia, dan penyakit paru lainnya.',
                'education' => 'S1 FK UNHAS, Sp.P FKUI',
                'experience' => '11 tahun pengalaman',
                'is_active' => true,
            ],
            [
                'name' => 'Lestari Wulandari',
                'specialization' => 'Oftalmologi',
                'description' => 'Spesialis mata dengan keahlian dalam bedah katarak, glaukoma, dan perawatan retina.',
                'education' => 'S1 FK UNIBRAW, Sp.M FKUI',
                'experience' => '13 tahun pengalaman',
                'is_active' => true,
            ],
            [
                'name' => 'Arief Rahman',
                'specialization' => 'Urologi',
                'description' => 'Dokter spesialis urologi yang menangani masalah saluran kemih dan sistem reproduksi pria.',
                'education' => 'S1 FK UNSRI, Sp.U FKUI',
                'experience' => '14 tahun pengalaman',
                'is_active' => true,
            ],
            [
                'name' => 'Nadia Fitriani',
                'specialization' => 'Psikiatri',
                'description' => 'Spesialis kesehatan jiwa yang menangani depresi, kecemasan, dan gangguan mental lainnya.',
                'education' => 'S1 FK UNAND, Sp.KJ FKUI',
                'experience' => '7 tahun pengalaman',
                'is_active' => true,
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}
