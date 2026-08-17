<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananTerpadu;
use App\Models\Setting;
use App\Services\ImageService;
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

    public function updateLogos(Request $request)
    {
        $request->validate([
            'logo_1' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:5120',
            'logo_2' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:5120',
            'logo_3' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:5120',
            'logo_4' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:5120',
            'logo_5' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:5120',
        ]);

        $destinationPath = public_path('uploads/layanan-logos');

        for ($i = 1; $i <= 5; $i++) {
            $key = "logo_{$i}";
            if ($request->hasFile($key)) {
                $filename = ImageService::compressAndUpload($request->file($key), $destinationPath, 600, 90);
                Setting::set("layanan_logo_{$i}", 'uploads/layanan-logos/'.$filename);
            }
        }

        return redirect()->route('admin.layanan.index')->with('success', 'Logo instansi & mitra berhasil diperbarui!');
    }
}
