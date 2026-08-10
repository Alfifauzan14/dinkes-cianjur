<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PpidTanggapanMail;
use App\Models\PpidPermohonan;
use App\Models\PpidSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PpidPermohonanController extends Controller
{
    /**
     * Display a listing of PPID permohonan.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $query = PpidPermohonan::query();

        if (in_array($status, ['pending', 'disetujui', 'ditolak'])) {
            $query->where('status', $status);
        }

        $permohonans = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        $stats = [
            'total' => PpidPermohonan::count(),
            'pending' => PpidPermohonan::where('status', 'pending')->count(),
            'disetujui' => PpidPermohonan::where('status', 'disetujui')->count(),
            'ditolak' => PpidPermohonan::where('status', 'ditolak')->count(),
        ];

        $ppidSetting = PpidSetting::instance();

        return view('admin.ppid.permohonan.index', compact('permohonans', 'status', 'stats', 'ppidSetting'));
    }

    /**
     * Display the specified PPID permohonan.
     */
    public function show(int $id): View
    {
        $permohonan = PpidPermohonan::findOrFail($id);

        return view('admin.ppid.permohonan.show', compact('permohonan'));
    }

    /**
     * Update the status of the specified PPID permohonan.
     */
    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'string', 'in:pending,disetujui,ditolak'],
            'tanggapan' => ['nullable', 'string', 'max:2000'],
            'file_tanggapan' => ['nullable', 'file', 'max:20480'], // max 20MB
        ]);

        $permohonan = PpidPermohonan::findOrFail($id);
        $oldFile = $permohonan->file_tanggapan;

        $updateData = [
            'status' => $request->status,
            'tanggapan' => $request->tanggapan,
        ];

        if ($request->hasFile('file_tanggapan')) {
            // Delete old file if exists
            if ($oldFile && Storage::disk('public')->exists($oldFile)) {
                Storage::disk('public')->delete($oldFile);
            }

            $file = $request->file('file_tanggapan');
            $filename = time().'_'.preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('ppid_tanggapan', $filename, 'public');
            $updateData['file_tanggapan'] = $path;
        }

        $permohonan->update($updateData);

        // Send email if applicant filled email address
        $emailSent = false;
        $emailError = null;

        if ($permohonan->email) {
            try {
                $fromEmail = PpidSetting::instance()->email_ppid;
                Mail::to($permohonan->email)->send(new PpidTanggapanMail($permohonan, $fromEmail));
                $emailSent = true;
            } catch (\Exception $e) {
                \Log::error('Gagal mengirim email PPID: '.$e->getMessage());
                $emailError = $e->getMessage();
            }
        }

        if ($emailSent) {
            return redirect()->route('admin.ppid.permohonan.show', $id)
                ->with('success', 'Status permohonan berhasil diperbarui dan email tanggapan telah dikirim ke pemohon.');
        } elseif ($permohonan->email && $emailError) {
            return redirect()->route('admin.ppid.permohonan.show', $id)
                ->with('success', 'Status permohonan berhasil diperbarui, namun email gagal dikirim: '.$emailError);
        } else {
            return redirect()->route('admin.ppid.permohonan.show', $id)
                ->with('success', 'Status permohonan berhasil diperbarui. (Email tidak dikirim karena pemohon tidak mencantumkan email)');
        }
    }

    /**
     * Update the PPID email address used for sending responses.
     */
    public function updateEmail(Request $request): RedirectResponse
    {
        $request->validate([
            'email_ppid' => ['required', 'email', 'max:255'],
        ]);

        PpidSetting::instance()->update([
            'email_ppid' => $request->email_ppid,
        ]);

        return redirect()->route('admin.ppid.permohonan.index')
            ->with('success', 'Email PPID berhasil diperbarui.');
    }
}
