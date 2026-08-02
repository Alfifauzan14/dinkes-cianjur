@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('header_title', 'Dashboard')

@section('content')
<div class="welcome-banner">
    <h2 class="welcome-title">Selamat Datang, {{ Auth::user()->name }}!</h2>
    <p class="welcome-desc">Di portal ini, Anda dapat mengelola semua komponen landing page, layanan kesehatan, data PPID, dan informasi profil Dinas Kesehatan Kabupaten Cianjur.</p>
</div>

<!-- Stats Grid (cohesive style with stats before) -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon-wrapper">
            <span class="material-icons stat-icon">medical_services</span>
        </div>
        <div class="stat-data">
            <span class="stat-number">16</span>
            <span class="stat-label">Total Layanan Terpadu</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon-wrapper">
            <span class="material-icons stat-icon">folder_open</span>
        </div>
        <div class="stat-data">
            <span class="stat-number">38</span>
            <span class="stat-label">Dokumen PPID Publik</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon-wrapper">
            <span class="material-icons stat-icon">people</span>
        </div>
        <div class="stat-data">
            <span class="stat-number">142</span>
            <span class="stat-label">Permohonan Informasi</span>
        </div>
    </div>
</div>
@endsection
