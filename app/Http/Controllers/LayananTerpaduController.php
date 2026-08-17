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

        return view('layanan.index', compact('wargaServices', 'faskesServices', 'nakesServices'));
    }

    /**
     * Display details of a specific Layanan Terpadu service.
     */
    public function show(int $id): View
    {
        $service = LayananTerpadu::findOrFail($id);

        return view('layanan.detail', compact('service'));
    }
}
