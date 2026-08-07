<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display the public archive of news articles.
     */
    public function index(Request $request)
    {
        $query = Berita::where('status', 'published');

        // Pencarian publik
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter kategori publik
        if ($request->filled('category') && $request->input('category') !== 'Semua') {
            $query->where('category', $request->input('category'));
        }

        // Ambil berita utama (terbaru) untuk ditampilkan di bagian featured jika ada
        $featuredBerita = null;
        if (! $request->filled('search') && (! $request->filled('category') || $request->input('category') === 'Semua')) {
            $featuredBerita = Berita::where('status', 'published')
                ->orderBy('created_at', 'desc')
                ->first();
        }

        // Paginasi berita reguler (kecuali yang dijadikan featured & recent jika sedang tidak memfilter/mencari)
        $excludeIds = [];
        if ($featuredBerita) {
            $excludeIds[] = $featuredBerita->id;
        }

        // 2 rilis berita horizontal pendamping featured
        $recentBeritas = [];
        if ($featuredBerita) {
            $recentBeritas = Berita::where('status', 'published')
                ->where('id', '!=', $featuredBerita->id)
                ->orderBy('created_at', 'desc')
                ->take(2)
                ->get();

            foreach ($recentBeritas as $recent) {
                $excludeIds[] = $recent->id;
            }
        }

        $beritasQuery = Berita::where('status', 'published')
            ->orderBy('created_at', 'desc');

        if (! empty($excludeIds)) {
            $beritasQuery->whereNotIn('id', $excludeIds);
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $beritasQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && $request->input('category') !== 'Semua') {
            $beritasQuery->where('category', $request->input('category'));
        }

        $beritas = $beritasQuery->paginate(6)->withQueryString();

        $kategoris = Kategori::ofType('berita')->get();

        return view('berita', compact('featuredBerita', 'beritas', 'recentBeritas', 'kategoris'));
    }

    /**
     * Display a single news article.
     */
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Tingkatkan view count
        $berita->increment('views');

        // Ambil artikel populer lainnya untuk sidebar rujukan pembaca
        $popularBeritas = Berita::where('status', 'published')
            ->where('id', '!=', $berita->id)
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        return view('berita.show', compact('berita', 'popularBeritas'));
    }
}
