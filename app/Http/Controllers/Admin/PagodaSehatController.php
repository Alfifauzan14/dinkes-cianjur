<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PagodaSehatCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagodaSehatController extends Controller
{
    public function index()
    {
        $cards = PagodaSehatCard::orderBy('order_index')->get();

        return view('admin.pagodasehat.index', compact('cards'));
    }

    public function create()
    {
        return view('admin.pagodasehat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'url' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['title', 'description', 'url']);
        $data['order_index'] = PagodaSehatCard::max('order_index') + 1;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pagoda-cards', 'public');
        }

        PagodaSehatCard::create($data);

        return redirect()->route('admin.pagodasehat.index')
            ->with('success', 'Kartu Pagoda Sehat berhasil ditambahkan.');
    }

    public function edit(PagodaSehatCard $pagodasehat)
    {
        return view('admin.pagodasehat.edit', compact('pagodasehat'));
    }

    public function update(Request $request, PagodaSehatCard $pagodasehat)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'url' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['title', 'description', 'url']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pagoda-cards', 'public');
        }

        $pagodasehat->update($data);

        return redirect()->route('admin.pagodasehat.index')
            ->with('success', 'Kartu Pagoda Sehat berhasil diperbarui.');
    }

    public function destroy(PagodaSehatCard $pagodasehat)
    {
        $pagodasehat->delete();

        return redirect()->route('admin.pagodasehat.index')
            ->with('success', 'Kartu Pagoda Sehat berhasil dihapus.');
    }

    public function move(Request $request, PagodaSehatCard $pagodasehat)
    {
        $request->validate([
            'direction' => 'required|in:up,down',
        ]);

        $all = PagodaSehatCard::orderBy('order_index')->orderBy('id')->get();
        $position = $all->pluck('id')->values()->search($pagodasehat->id);

        if ($position === false) {
            return response()->json(['success' => false]);
        }
        if ($request->direction === 'up' && $position === 0) {
            return response()->json(['success' => false]);
        }
        if ($request->direction === 'down' && $position === $all->count() - 1) {
            return response()->json(['success' => false]);
        }

        $swapPosition = $request->direction === 'up' ? $position - 1 : $position + 1;

        DB::transaction(function () use ($all, $position, $swapPosition) {
            $ids = $all->pluck('id')->all();
            [$ids[$position], $ids[$swapPosition]] = [$ids[$swapPosition], $ids[$position]];

            foreach ($ids as $i => $id) {
                PagodaSehatCard::where('id', $id)->update(['order_index' => $i + 1]);
            }
        });

        return response()->json(['success' => true]);
    }
}
