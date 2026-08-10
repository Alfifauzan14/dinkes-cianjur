<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tanggapan Permohonan Informasi PPID</title>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #1e293b;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .header {
            background-color: #004F3B;
            padding: 24px;
            text-align: center;
            color: #ffffff;
        }
        .header h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
        }
        .header p {
            margin: 4px 0 0 0;
            font-size: 13px;
            opacity: 0.8;
        }
        .content {
            padding: 32px 24px;
        }
        .greeting {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #0f172a;
        }
        .lead {
            font-size: 15px;
            margin-bottom: 24px;
            color: #475569;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
            font-size: 14px;
        }
        .details-table th, .details-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #f1f5f9;
        }
        .details-table th {
            width: 35%;
            color: #64748b;
            font-weight: 600;
            background-color: #f8fafc;
        }
        .details-table td {
            color: #1e293b;
        }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
        }
        .badge-pending {
            background-color: #fffbeb;
            color: #b45309;
            border: 1px solid #fde68a;
        }
        .badge-disetujui {
            background-color: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }
        .badge-ditolak {
            background-color: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
        .response-box {
            background-color: #f8fafc;
            border-left: 4px solid #009966;
            padding: 16px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 24px;
        }
        .response-title {
            font-weight: 600;
            font-size: 13px;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 6px;
        }
        .response-text {
            font-size: 14px;
            color: #334155;
            white-space: pre-wrap;
            margin: 0;
        }
        .attachment-note {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e40af;
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 14px;
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }
        .footer {
            background-color: #f1f5f9;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            margin: 4px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Dinas Kesehatan Kabupaten Cianjur</h2>
            <p>Pejabat Pengelola Informasi dan Dokumentasi (PPID)</p>
        </div>
        <div class="content">
            <div class="greeting">Halo, {{ $permohonan->nama_pemohon }}</div>
            <div class="lead">
                Kami ingin menginformasikan bahwa permohonan informasi publik yang Anda ajukan telah ditinjau dan diperbarui oleh Admin PPID Dinas Kesehatan Kabupaten Cianjur.
            </div>

            <table class="details-table">
                <tr>
                    <th>Nomor Permohonan</th>
                    <td><strong>{{ $permohonan->token }}</strong></td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $permohonan->nik }}</td>
                </tr>
                <tr>
                    <th>Rincian Informasi</th>
                    <td>{{ $permohonan->rincian_informasi }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($permohonan->status === 'pending')
                            <span class="badge badge-pending">Pending</span>
                        @elseif($permohonan->status === 'disetujui')
                            <span class="badge badge-disetujui">Disetujui</span>
                        @else
                            <span class="badge badge-ditolak">Ditolak</span>
                        @endif
                    </td>
                </tr>
            </table>

            @if($permohonan->tanggapan)
                <div class="response-box" style="{{ $permohonan->status === 'ditolak' ? 'border-left-color: #b91c1c;' : '' }}">
                    <div class="response-title">Catatan / Tanggapan dari Admin:</div>
                    <p class="response-text">{{ $permohonan->tanggapan }}</p>
                </div>
            @endif

            @if($permohonan->file_tanggapan)
                <div class="attachment-note">
                    <strong>Informasi:</strong> Dokumen/data yang Anda minta telah dilampirkan pada email ini. Silakan unduh lampiran untuk mengakses dokumen tersebut.
                </div>
            @endif

            <p style="font-size: 14px; color: #475569; margin-top: 32px;">
                Jika Anda memiliki pertanyaan lebih lanjut, silakan hubungi kami melalui kontak resmi PPID Dinas Kesehatan Kabupaten Cianjur.
            </p>
        </div>
        <div class="footer">
            <p><strong>PPID Dinas Kesehatan Kabupaten Cianjur</strong></p>
            <p>Jl. Raya Bandung No. 65, Karangtengah, Cianjur</p>
            <p>Email ini dikirim otomatis oleh sistem, mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>
