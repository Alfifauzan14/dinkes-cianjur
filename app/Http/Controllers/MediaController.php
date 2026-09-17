<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Infografis;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function index(): View
    {
        $recentGaleri = Galeri::with('thumbnail')
            ->withCount('photos')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        $recentInfografis = Infografis::orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('media.index', compact('recentGaleri', 'recentInfografis'));
    }

    public function galeriKegiatan(Request $request): View
    {
        $query = Galeri::with('thumbnail')->withCount('photos')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }

        if ($request->filled('category') && $request->input('category') !== 'Semua') {
            $query->where('category', $request->input('category'));
        }

        $galeris = $query->paginate(12)->withQueryString();

        return view('media.galeri', compact('galeris'));
    }

    public function show(string $slug): View
    {
        $galeri = Galeri::where('slug', $slug)
            ->with(['photos' => function ($query) {
                $query->orderBy('order');
            }])
            ->firstOrFail();

        return view('media.show', compact('galeri'));
    }

    public function infografis(): View
    {
        $infografis = Infografis::orderBy('created_at', 'desc')->paginate(12);

        return view('media.infografis', compact('infografis'));
    }
}
