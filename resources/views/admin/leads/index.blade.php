@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Manajemen Leads</h2>

    <a href="{{ route('leads.create') }}" class="btn btn-primary mb-3">+ Tambah Lead</a>

    {{-- Filter --}}
    <form method="GET" class="mb-3">
        <select name="status" onchange="this.form.submit()" class="form-select w-auto d-inline">
            <option value="">-- Semua Status --</option>
            <option value="baru" {{ request('status')=='baru'?'selected':'' }}>Baru</option>
            <option value="follow-up" {{ request('status')=='follow-up'?'selected':'' }}>Follow Up</option>
            <option value="closing" {{ request('status')=='closing'?'selected':'' }}>Closing</option>
            <option value="gagal" {{ request('status')=='gagal'?'selected':'' }}>Gagal</option>
        </select>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Asal Leads</th>
                <th>Alasan Pembelian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $lead)
            <tr>
                <td>{{ $lead->nama }}</td>
                <td>{{ $lead->kontak }}</td>
                <td>{{ $lead->asal_leads }}</td>
                <td>{{ $lead->alasan_pembelian }}</td>
                <td>{{ ucfirst($lead->status) }}</td>
                <td>
                    <a href="{{ route('leads.edit', $lead) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('leads.destroy', $lead) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus lead ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $leads->links() }}
</div>
@endsection
