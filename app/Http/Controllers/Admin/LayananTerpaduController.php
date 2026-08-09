<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananTerpadu;
use Illuminate\Http\Request;

class LayananTerpaduController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');
        $search = $request->query('search');

        $layanans = LayananTerpadu::query()
            ->when($type, fn ($q) => $q->where('type', $type))
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', '%'.$search.'%')
                        ->orWhere('description', 'like', '%'.$search.'%');
                });
            })
            ->orderBy('type')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.layanan.index', compact('layanans', 'type', 'search'));
    }

    public function create()
    {
        $icons = ['users', 'smile', 'chat', 'desktop', 'bag', 'globe', 'file'];

        return view('admin.layanan.create', compact('icons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:Warga,Faskes,Nakes',
            'icon' => 'required|string|in:users,smile,chat,desktop,bag,globe,file',
            'link' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'procedures' => 'nullable|string',
            'processing_time' => 'nullable|string|max:255',
            'tariff' => 'nullable|string|max:255',
            'helpdesk_email' => 'nullable|email|max:255',
            'helpdesk_phone' => 'nullable|string|max:255',
        ]);

        LayananTerpadu::create($request->only(
            'name', 'type', 'icon', 'link', 'description',
            'requirements', 'procedures', 'processing_time',
            'tariff', 'helpdesk_email', 'helpdesk_phone'
        ));

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function edit(LayananTerpadu $layananTerpadu)
    {
        $icons = ['users', 'smile', 'chat', 'desktop', 'bag', 'globe', 'file'];

        return view('admin.layanan.edit', [
            'layanan' => $layananTerpadu,
            'icons' => $icons,
        ]);
    }

    public function update(Request $request, LayananTerpadu $layananTerpadu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:Warga,Faskes,Nakes',
            'icon' => 'required|string|in:users,smile,chat,desktop,bag,globe,file',
            'link' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'procedures' => 'nullable|string',
            'processing_time' => 'nullable|string|max:255',
            'tariff' => 'nullable|string|max:255',
            'helpdesk_email' => 'nullable|email|max:255',
            'helpdesk_phone' => 'nullable|string|max:255',
        ]);

        $layananTerpadu->update($request->only(
            'name', 'type', 'icon', 'link', 'description',
            'requirements', 'procedures', 'processing_time',
            'tariff', 'helpdesk_email', 'helpdesk_phone'
        ));

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy(LayananTerpadu $layananTerpadu)
    {
        $layananTerpadu->delete();

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus!');
    }
}
