<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data untuk homepage
        $services = Service::active()->take(6)->get();
        $articles = Article::published()->latest()->take(3)->get();
        $doctors = Doctor::active()->take(8)->get();
        
        // Statistik dummy untuk hero section
        $stats = [
            'hospitals' => 40,
            'medical_staff' => 2500,
            'patients' => 50000,
            'insurance' => 150
        ];

        return view('home', compact('services', 'articles', 'doctors', 'stats'));
    }
}
