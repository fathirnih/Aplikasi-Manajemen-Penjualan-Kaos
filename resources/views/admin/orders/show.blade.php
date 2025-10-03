@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Detail Order #{{ $order->id }}</h2>

    <p><strong>Lead:</strong> {{ $order->lead->nama ?? '-' }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_harga) }}</p>

    <h4>Items</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Bahan</th>
                <th>Ukuran</th>
                <th>Quantity</th>
                <th>Customisasi</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->bahan }}</td>
                <td>{{ $item->ukuran }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ is_array($item->customisasi) ? implode(', ', $item->customisasi) : $item->customisasi }}</td>
                <td>Rp {{ number_format($item->harga) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
