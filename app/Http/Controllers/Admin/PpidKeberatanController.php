<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PpidKeberatanMail;
use App\Models\PpidKeberatan;
use App\Models\PpidSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        ]);

        $keberatan = PpidKeberatan::with('permohonan')->findOrFail($id);
        $keberatan->update([
            'status' => $request->status,
            'tanggapan_admin' => $request->tanggapan_admin,
        ]);

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

