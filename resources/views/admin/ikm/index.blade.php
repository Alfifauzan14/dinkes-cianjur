@extends('admin.layouts.admin')

@section('title', 'Data Indeks Kepuasan Masyarakat')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data IKM</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data IKM</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        
        {{-- Stats Row --}}
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $stats['sangat_puas'] }}</h3>
                        <p>Sangat Puas</p>
                    </div>
                    <div class="icon">
                        <span class="material-icons" style="font-size: 70px; opacity: 0.5;">sentiment_very_satisfied</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $stats['puas'] }}</h3>
                        <p>Puas</p>
                    </div>
                    <div class="icon">
                        <span class="material-icons" style="font-size: 70px; opacity: 0.5;">sentiment_satisfied</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $stats['cukup'] }}</h3>
                        <p>Cukup</p>
                    </div>
                    <div class="icon">
                        <span class="material-icons" style="font-size: 70px; opacity: 0.5;">sentiment_neutral</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $stats['kurang'] }}</h3>
                        <p>Kurang</p>
                    </div>
                    <div class="icon">
                        <span class="material-icons" style="font-size: 70px; opacity: 0.5;">sentiment_dissatisfied</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table Data --}}
        <div class="card card-outline card-success">
            <div class="card-header" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-success">rate_review</span>
                    <span class="font-weight-bold card-title-label">Daftar Masukan IKM</span>
                </span>
            </div>
            <div class="card-body">
                <table id="table-ikm" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>WhatsApp</th>
                            <th>Rating</th>
                            <th>Masukan / Keluhan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ratings as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                            <td>{{ $item->name ?? '-' }}</td>
                            <td>
                                @if($item->whatsapp)
                                    <a href="https://wa.me/{{ $item->whatsapp }}" target="_blank" class="text-success"><i class="fab fa-whatsapp"></i> {{ $item->whatsapp }}</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($item->rating == 'sangat_puas')
                                    <span class="badge badge-success"><span class="material-icons" style="font-size:12px;vertical-align:text-bottom;">sentiment_very_satisfied</span> Sangat Puas</span>
                                @elseif($item->rating == 'puas')
                                    <span class="badge badge-info"><span class="material-icons" style="font-size:12px;vertical-align:text-bottom;">sentiment_satisfied</span> Puas</span>
                                @elseif($item->rating == 'cukup')
                                    <span class="badge badge-warning"><span class="material-icons" style="font-size:12px;vertical-align:text-bottom;">sentiment_neutral</span> Cukup</span>
                                @else
                                    <span class="badge badge-danger"><span class="material-icons" style="font-size:12px;vertical-align:text-bottom;">sentiment_dissatisfied</span> Kurang</span>
                                @endif
                            </td>
                            <td>{{ $item->description ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(function () {
    $("#table-ikm").DataTable({
        "responsive": true,
        "autoWidth": false,
        "order": [[ 1, "desc" ]] // Urutkan berdasarkan tanggal terbaru
    });
});
</script>
@endsection
