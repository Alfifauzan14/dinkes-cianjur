<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PpidKeberatanMail;
use App\Models\PpidKeberatan;
use App\Models\PpidSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PpidKeberatanController extends Controller
{
    /**
     * Display a listing of keberatan.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $query = PpidKeberatan::with('permohonan');

        if (in_array($status, ['pending', 'ditanggapi'])) {
            $query->where('status', $status);
        }

        $keberatans = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        $stats = [
            'total' => PpidKeberatan::count(),
            'pending' => PpidKeberatan::where('status', 'pending')->count(),
            'ditanggapi' => PpidKeberatan::where('status', 'ditanggapi')->count(),
        ];

        return view('admin.ppid.keberatan.index', compact('keberatans', 'status', 'stats'));
    }

    /**
     * Display the specified keberatan.
     */
    public function show(int $id): View
    {
        $keberatan = PpidKeberatan::with('permohonan')->findOrFail($id);

        return view('admin.ppid.keberatan.show', compact('keberatan'));
    }

    /**
     * Update status & tanggapan admin.
     */
    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'string', 'in:pending,ditanggapi'],
            'tanggapan_admin' => ['nullable', 'string', 'max:3000'],
            'file_tanggapan' => ['nullable', 'file', 'max:20480'], // max 20MB
        ]);

        $keberatan = PpidKeberatan::with('permohonan')->findOrFail($id);
        $oldFile = $keberatan->file_tanggapan;

        $updateData = [
            'status' => $request->status,
            'tanggapan_admin' => $request->tanggapan_admin,
        ];

        if ($request->hasFile('file_tanggapan')) {
            // Delete old file if exists
            if ($oldFile && Storage::disk('public')->exists($oldFile)) {
                Storage::disk('public')->delete($oldFile);
            }

            $file = $request->file('file_tanggapan');
            $filename = time().'_'.preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('ppid_tanggapan_keberatan', $filename, 'public');
            $updateData['file_tanggapan'] = $path;
        }

        $keberatan->update($updateData);

        // Send email to applicant
        $emailSent = false;
        $emailError = null;

        if ($keberatan->email) {
            try {
                $fromEmail = PpidSetting::instance()->email_ppid;
                Mail::to($keberatan->email)->send(new PpidKeberatanMail($keberatan, $fromEmail));
                $emailSent = true;
            } catch (\Exception $e) {
                \Log::error('Gagal mengirim email keberatan PPID: '.$e->getMessage());
                $emailError = $e->getMessage();
            }
        }

        if ($emailSent) {
            return redirect()
                ->route('admin.ppid.keberatan.show', $id)
                ->with('success', 'Tanggapan keberatan berhasil disimpan dan email telah terkirim ke pemohon.');
        } elseif ($keberatan->email && $emailError) {
            return redirect()
                ->route('admin.ppid.keberatan.show', $id)
                ->with('success', 'Tanggapan keberatan berhasil disimpan, namun email gagal terkirim: '.$emailError);
        } else {
            return redirect()
                ->route('admin.ppid.keberatan.show', $id)
                ->with('success', 'Tanggapan keberatan berhasil disimpan.');
        }
    }
}
