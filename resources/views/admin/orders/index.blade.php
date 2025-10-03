@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Daftar Order</h2>

    <a href="{{ route('admin.orders.create', 0) }}" class="btn btn-primary mb-3">+ Buat Order Baru</a>

    
    <a href="{{ route('admin.orders.create', $order->lead->id) }}" class="btn btn-primary btn-sm">
            Buat Order Baru
        </a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Lead</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->lead->nama ?? '-' }}</td>
                <td>Rp {{ number_format($order->total_harga) }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-info btn-sm">Detail</a>
                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus order ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection
