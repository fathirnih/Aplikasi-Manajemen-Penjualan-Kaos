@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Tambah Lead Baru</h2>

    <form action="{{ route('leads.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="kontak" class="form-label">Kontak</label>
            <input type="text" name="kontak" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="asal_leads" class="form-label">Asal Leads</label>
            <input type="text" name="asal_leads" class="form-control">
        </div>

        <div class="mb-3">
            <label for="alasan_pembelian" class="form-label">Alasan Pembelian</label>
            <textarea name="alasan_pembelian" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="baru">Baru</option>
                <option value="follow-up">Follow Up</option>
                <option value="closing">Closing</option>
                <option value="gagal">Gagal</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('leads.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
