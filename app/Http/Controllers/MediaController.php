<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MediaController extends Controller
{
    /**
     * Display the public Media / Galeri page.
     */
    public function index(Request $request): View
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

        return view('media', compact('galeris'));
    }
}
