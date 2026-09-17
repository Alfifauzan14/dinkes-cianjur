@extends('admin.layouts.admin')
@section('title', 'Kelola Agenda')
@section('header_title', 'Kelola Agenda Kegiatan')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success">event</span>
            <span class="font-weight-bold card-title-label">Kelola Agenda</span>
        </span>

        {{-- Search & Filter --}}
        <form action="{{ route('admin.agenda.index') }}" method="GET" class="d-flex align-items-center" style="gap: 8px; flex-wrap: wrap;">
            <input type="hidden" name="time_filter" value="{{ request('time_filter', 'all') }}">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari judul, lokasi, tgl (17 Ags, 17-08)..." style="width: 270px;">
            <select name="status" class="custom-select custom-select-sm" onchange="this.form.submit()" style="width: 140px;">
                <option value="">Semua Status</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Diterbitkan</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draf</option>
            </select>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.agenda.index', ['time_filter' => request('time_filter', 'all')]) }}" class="btn btn-sm btn-outline-secondary" title="Reset Filter">
                    <span class="material-icons" style="font-size:14px;vertical-align:middle;">clear</span> Reset
                </a>
            @endif
        </form>

        {{-- Action Buttons --}}
        <div class="d-flex ml-auto" style="gap: 8px;">
            <a href="{{ route('admin.agenda.import_form') }}" class="btn btn-sm btn-outline-secondary" style="white-space:nowrap;">
                <span class="material-icons" style="font-size:16px;">upload_file</span> Impor CSV
            </a>
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalTambahAgenda" style="white-space:nowrap;">
                <span class="material-icons" style="font-size:16px;">add</span> Tambah Agenda
            </button>
        </div>
    </div>

    {{-- Tabs with Counter Badges --}}
    <div class="px-4 pt-3 pb-0 bg-white" style="border-bottom: 1px solid #E2E8F0;">
        <ul class="nav nav-tabs border-0" id="agenda-time-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ request('time_filter', 'all') === 'all' ? 'active font-weight-bold text-success' : 'text-secondary' }}"
                   @style([
                       'border-bottom: 3px solid ' . (request('time_filter', 'all') === 'all' ? '#009966' : 'transparent'),
                       'border-radius: 0',
                       'padding-bottom: 12px',
                       'display: inline-flex',
                       'align-items: center',
                       'gap: 8px'
                   ])
                   href="{{ route('admin.agenda.index', array_merge(request()->except('page'), ['time_filter' => 'all'])) }}">
                    <span>Semua Agenda</span>
                    <span class="badge" style="background:#F1F5F9;color:#475569;font-weight:700;font-size:11px;">{{ $countAll }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('time_filter') === 'today' ? 'active font-weight-bold text-success' : 'text-secondary' }}"
                   @style([
                       'border-bottom: 3px solid ' . (request('time_filter') === 'today' ? '#009966' : 'transparent'),
                       'border-radius: 0',
                       'padding-bottom: 12px',
                       'display: inline-flex',
                       'align-items: center',
                       'gap: 8px'
                   ])
                   href="{{ route('admin.agenda.index', array_merge(request()->except('page'), ['time_filter' => 'today'])) }}">
                    <span>Hari Ini</span>
                    @if($countToday > 0)
                        <span class="badge" style="background:#009966;color:#ffffff;font-weight:700;font-size:11px;">{{ $countToday }}</span>
                    @else
                        <span class="badge" style="background:#F1F5F9;color:#475569;font-weight:700;font-size:11px;">{{ $countToday }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('time_filter') === 'upcoming' ? 'active font-weight-bold text-success' : 'text-secondary' }}"
                   @style([
                       'border-bottom: 3px solid ' . (request('time_filter') === 'upcoming' ? '#009966' : 'transparent'),
                       'border-radius: 0',
                       'padding-bottom: 12px',
                       'display: inline-flex',
                       'align-items: center',
                       'gap: 8px'
                   ])
                   href="{{ route('admin.agenda.index', array_merge(request()->except('page'), ['time_filter' => 'upcoming'])) }}">
                    <span>Akan Datang</span>
                    <span class="badge" style="background:#F1F5F9;color:#475569;font-weight:700;font-size:11px;">{{ $countUpcoming }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('time_filter') === 'past' ? 'active font-weight-bold text-success' : 'text-secondary' }}"
                   @style([
                       'border-bottom: 3px solid ' . (request('time_filter') === 'past' ? '#009966' : 'transparent'),
                       'border-radius: 0',
                       'padding-bottom: 12px',
                       'display: inline-flex',
                       'align-items: center',
                       'gap: 8px'
                   ])
                   href="{{ route('admin.agenda.index', array_merge(request()->except('page'), ['time_filter' => 'past'])) }}">
                    <span>Selesai / Lampau</span>
                    <span class="badge" style="background:#F1F5F9;color:#475569;font-weight:700;font-size:11px;">{{ $countPast }}</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nama Agenda / Kegiatan</th>
                        <th style="width:160px;">Tanggal</th>
                        <th style="width:130px;">Waktu</th>
                        <th style="width:170px;">Lokasi</th>
                        <th style="width:120px;">Status</th>
                        <th class="text-center" style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agendas as $agenda)
                    <tr>
                        <td>
                            <div class="font-weight-bold text-dark">{{ $agenda->title }}</div>
                            <small class="text-muted">{{ Str::limit($agenda->description, 90) }}</small>
                        </td>
                        <td style="white-space:nowrap;">
                            <div class="font-weight-bold text-dark">{{ $agenda->date->format('d M Y') }}</div>
                            @php
                                $agendaDateStr = $agenda->date->format('Y-m-d');
                                $todayDateStr = \Carbon\Carbon::today()->toDateString();
                            @endphp
                            @if($agendaDateStr === $todayDateStr)
                                <span class="badge" style="background:#DEF7EC;color:#03543F;font-size:10px;padding:2px 6px;border-radius:3px;">Hari Ini</span>
                            @elseif($agendaDateStr > $todayDateStr)
                                <span class="badge" style="background:#E0F2FE;color:#0369A1;font-size:10px;padding:2px 6px;border-radius:3px;">Akan Datang</span>
                            @else
                                <span class="badge" style="background:#F1F5F9;color:#64748B;font-size:10px;padding:2px 6px;border-radius:3px;">Selesai</span>
                            @endif
                        </td>
                        <td class="text-secondary">{{ $agenda->time_start }} – {{ $agenda->time_end }}</td>
                        <td>
                            <span class="material-icons text-success" style="font-size:14px;vertical-align:middle;">place</span>
                            <span class="text-secondary">{{ $agenda->location }}</span>
                        </td>
                        <td>
                            @if($agenda->isPending())
                                <span class="badge" style="background:#DBEAFE;color:#1E40AF;padding:4px 10px;border-radius:3px;">Menunggu</span>
                            @elseif($agenda->status == 'published')
                                <span class="badge" style="background:#DEF7EC;color:#03543F;padding:4px 10px;border-radius:3px;">Diterbitkan</span>
                            @else
                                <span class="badge" style="background:#F3F4F6;color:#374151;padding:4px 10px;border-radius:3px;">Draf</span>
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            <div class="btn-action-group">
                                <button type="button"
                                    class="btn-action btn-action-edit btn-edit-agenda"
                                    title="Edit"
                                    data-id="{{ $agenda->id }}"
                                    data-title="{{ $agenda->title }}"
                                    data-date="{{ $agenda->date->format('Y-m-d') }}"
                                    data-location="{{ $agenda->location }}"
                                    data-time_start="{{ $agenda->time_start }}"
                                    data-time_end="{{ $agenda->time_end }}"
                                    data-description="{{ $agenda->description ?? '' }}"
                                    data-status="{{ $agenda->status }}"
                                    data-toggle="modal" data-target="#modalEditAgenda">
                                    <span class="material-icons" style="font-size:16px;">edit</span>
                                </button>
                                <form action="{{ route('admin.agenda.destroy', $agenda->id) }}" method="POST" id="del-agenda-{{ $agenda->id }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-action-delete" title="Hapus"
                                        onclick="confirmDelete('del-agenda-{{ $agenda->id }}')">
                                        <span class="material-icons" style="font-size:16px;">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size:48px;display:block;margin-bottom:8px;color:#D1D5DB;">event_busy</span>
                            Belum ada agenda kegiatan yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($agendas->hasPages())
    <div class="card-footer">{{ $agendas->links() }}</div>
    @endif
</div>

{{-- ======================================== --}}
{{-- MODAL: TAMBAH AGENDA                     --}}
{{-- ======================================== --}}
<div class="modal fade" id="modalTambahAgenda" tabindex="-1" role="dialog" aria-labelledby="modalTambahAgendaLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.agenda.store') }}" method="POST">
                @csrf
                <div class="modal-header" style="background:#009966;color:#fff;border-radius:0;">
                    <h5 class="modal-title" id="modalTambahAgendaLabel">
                        <span class="material-icons" style="vertical-align:middle;margin-right:6px;">event</span>
                        Tambah Agenda Baru
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tambah_title">Nama Kegiatan / Agenda <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="tambah_title" class="form-control" placeholder="Masukkan nama acara/kegiatan..." required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tambah_date">Tanggal Kegiatan <span class="text-danger">*</span></label>
                                <input type="date" name="date" id="tambah_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tambah_location">Tempat / Lokasi <span class="text-danger">*</span></label>
                                <input type="text" name="location" id="tambah_location" class="form-control" placeholder="Aula Dinkes, Posyandu Mawar..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tambah_time_start">Waktu Mulai <span class="text-danger">*</span></label>
                                <input type="time" name="time_start" id="tambah_time_start" class="form-control" value="08:00" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tambah_time_end">Waktu Selesai <span class="text-danger">*</span></label>
                                <input type="time" name="time_end" id="tambah_time_end" class="form-control" value="10:00" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tambah_description">Deskripsi <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                        <textarea name="description" id="tambah_description" class="form-control" rows="3" placeholder="Rincian singkat kegiatan atau materi rapat..."></textarea>
                    </div>
                    <div class="form-group mb-0">
                        <label for="tambah_status">Status Publikasi</label>
                        <select name="status" id="tambah_status" class="form-control" required>
                            <option value="published">Diterbitkan (Tampil di Publik)</option>
                            <option value="draft">Draf (Sembunyikan)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Jadwalkan Agenda
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ======================================== --}}
{{-- MODAL: EDIT AGENDA                       --}}
{{-- ======================================== --}}
<div class="modal fade" id="modalEditAgenda" tabindex="-1" role="dialog" aria-labelledby="modalEditAgendaLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="form-edit-agenda">
                @csrf @method('PUT')
                <div class="modal-header" style="background:#007A52;color:#fff;border-radius:0;">
                    <h5 class="modal-title" id="modalEditAgendaLabel">
                        <span class="material-icons" style="vertical-align:middle;margin-right:6px;">edit_calendar</span>
                        Edit Agenda
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_title">Nama Kegiatan / Agenda <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="edit_title" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_date">Tanggal Kegiatan <span class="text-danger">*</span></label>
                                <input type="date" name="date" id="edit_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_location">Tempat / Lokasi <span class="text-danger">*</span></label>
                                <input type="text" name="location" id="edit_location" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_time_start">Waktu Mulai <span class="text-danger">*</span></label>
                                <input type="time" name="time_start" id="edit_time_start" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_time_end">Waktu Selesai <span class="text-danger">*</span></label>
                                <input type="time" name="time_end" id="edit_time_end" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Deskripsi <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                        <textarea name="description" id="edit_description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group mb-0">
                        <label for="edit_status">Status Publikasi</label>
                        <select name="status" id="edit_status" class="form-control" required>
                            <option value="published">Diterbitkan (Tampil di Publik)</option>
                            <option value="draft">Draf (Sembunyikan)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-success-dark">
                          <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.querySelectorAll('.btn-edit-agenda').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var id = this.dataset.id;
        document.getElementById('edit_title').value      = this.dataset.title;
        document.getElementById('edit_date').value       = this.dataset.date;
        document.getElementById('edit_location').value   = this.dataset.location;
        document.getElementById('edit_time_start').value = this.dataset.time_start;
        document.getElementById('edit_time_end').value   = this.dataset.time_end;
        document.getElementById('edit_description').value= this.dataset.description;
        document.getElementById('edit_status').value     = this.dataset.status;
        document.getElementById('form-edit-agenda').action = '{{ url("admin/agenda") }}/' + id;
    });
});
</script>
@endsection
