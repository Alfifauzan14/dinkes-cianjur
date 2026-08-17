<?php

namespace App\Http\Controllers;

use App\Models\Faskes;
use App\Models\JenisFaskes;
use App\Models\Kecamatan;
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

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->input('search').'%');
        }

        if ($request->filled('kecamatan') && $request->input('kecamatan') !== 'Semua') {
            $query->where('kecamatan', $request->input('kecamatan'));
        }

        if ($request->filled('type') && $request->input('type') !== 'Semua') {
            $query->where('type', $request->input('type'));
        }

        $faskes = $query->orderBy('type')->orderBy('name')->get();
        $kecamatans = Kecamatan::orderBy('name')->get();
        $types = JenisFaskes::orderBy('name')->get();

        return view('layanan.faskes', compact('faskes', 'kecamatans', 'types'));
    }
}
