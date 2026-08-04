<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\View\View;

class MediaController extends Controller
{
    /**
     * Display the public Media / Galeri page.
     */
    public function index(): View
    {
        $galeris = Galeri::orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('media', compact('galeris'));
    }
}
