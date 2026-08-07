<?php

namespace App\Http\Controllers;

use App\Models\Faskes;
use App\Models\Kecamatan;
use App\Models\Profile;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the public Profile Dinkes page.
     */
    public function index(): View
    {
        $profile = Profile::first();

        return view('profil', compact('profile'));
    }

    /**
     * Display the Visi Misi page.
     */
    public function visiMisi(): View
    {
        $profile = Profile::first();
        $puskesmasCount = Faskes::where('type', 'Puskesmas')->count();
        $kecamatanCount = Kecamatan::count();

        return view('visi-misi', compact('profile', 'puskesmasCount', 'kecamatanCount'));
    }

    /**
     * Display the Struktur Organisasi page.
     */
    public function strukturOrganisasi(): View
    {
        $profile = Profile::first();

        return view('struktur-organisasi', compact('profile'));
    }
}
