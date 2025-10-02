<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $query = Doctor::active();
        
        // Filter berdasarkan spesialisasi jika ada
        if ($request->has('specialization') && $request->specialization != '') {
            $query->where('specialization', 'like', '%' . $request->specialization . '%');
        }
        
        // Filter berdasarkan nama jika ada
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $doctors = $query->paginate(12);
        $specializations = Doctor::active()
            ->select('specialization')
            ->distinct()
            ->pluck('specialization');
        
        return view('doctors.index', compact('doctors', 'specializations'));
    }

    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }
}
