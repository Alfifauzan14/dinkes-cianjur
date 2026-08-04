<?php

namespace App\Http\Controllers;

use App\Models\LayananTerpadu;
use Illuminate\View\View;

class LayananTerpaduController extends Controller
{
    /**
     * Display the public Layanan Terpadu page.
     */
    public function index(): View
    {
        $wargaServices = LayananTerpadu::where('type', 'Warga')->get();
        $faskesServices = LayananTerpadu::where('type', 'Faskes')->get();
        $nakesServices = LayananTerpadu::where('type', 'Nakes')->get();

        return view('layanan-terpadu', compact('wargaServices', 'faskesServices', 'nakesServices'));
    }
}
