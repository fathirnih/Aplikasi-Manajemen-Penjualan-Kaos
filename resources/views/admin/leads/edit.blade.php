@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Lead</h2>

    <form action="{{ route('leads.update', $lead) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" value="{{ $lead->nama }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="kontak" class="form-label">Kontak</label>
            <input type="text" name="kontak" value="{{ $lead->kontak }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="asal_leads" class="form-label">Asal Leads</label>
            <input type="text" name="asal_leads" value="{{ $lead->asal_leads }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="alasan_pembelian" class="form-label">Alasan Pembelian</label>
            <textarea name="alasan_pembelian" class="form-control">{{ $lead->alasan_pembelian }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="baru" {{ $lead->status == 'baru' ? 'selected' : '' }}>Baru</option>
                <option value="follow-up" {{ $lead->status == 'follow-up' ? 'selected' : '' }}>Follow Up</option>
                <option value="closing" {{ $lead->status == 'closing' ? 'selected' : '' }}>Closing</option>
                <option value="gagal" {{ $lead->status == 'gagal' ? 'selected' : '' }}>Gagal</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('leads.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
