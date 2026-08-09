<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MediaController extends Controller
{
    /**
     * Display the Media landing page with category cards.
     */
    public function index(): View
    {
        return view('media-index');
    }

    /**
     * Display the Galeri Kegiatan page (formerly /media).
     */
    public function galeriKegiatan(Request $request): View
    {
        $query = Galeri::orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }

        if ($request->filled('category') && $request->input('category') !== 'Semua') {
            $query->where('category', $request->input('category'));
        }

        $galeris = $query->paginate(12)->withQueryString();

        return view('media-galeri', compact('galeris'));
    }

    /**
     * Display the Infografis placeholder page.
     */
    public function infografis(): View
    {
        return view('media-infografis');
    }
}
