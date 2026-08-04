<?php

namespace App\Http\Controllers;

use App\Models\Faskes;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaskesController extends Controller
{
    /**
     * Display the Faskes page.
     */
    public function index(Request $request): View
    {
        $query = Faskes::query();

        if ($request->filled('kecamatan') && $request->input('kecamatan') !== 'Semua') {
            $query->where('kecamatan', $request->input('kecamatan'));
        }

        if ($request->filled('type') && $request->input('type') !== 'Semua') {
            $query->where('type', $request->input('type'));
        }

        $faskes = $query->orderBy('type')->orderBy('name')->get();
        $kecamatans = Faskes::select('kecamatan')->distinct()->orderBy('kecamatan')->pluck('kecamatan');

        return view('faskes', compact('faskes', 'kecamatans'));
    }
}
