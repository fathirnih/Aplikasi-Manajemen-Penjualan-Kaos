@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Buat Order Baru</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.orders.store') }}" method="POST">
        @csrf
        <input type="hidden" name="lead_id" value="{{ $lead->id }}">

        <h4>Lead: {{ $lead->nama }}</h4>

        <div class="mb-3">
            <label>Pilihan Item:</label>
            <div id="items-container">
                <div class="item-row mb-2">
                    <input type="text" name="items[0][bahan]" placeholder="Bahan (cotton/combed/premium)" class="form-control mb-1" required>
                    <input type="text" name="items[0][ukuran]" placeholder="Ukuran (S/M/L/XL/XXL)" class="form-control mb-1" required>
                    <input type="number" name="items[0][quantity]" placeholder="Qty" class="form-control mb-1" required>
                    <input type="text" name="items[0][customisasi][]" placeholder="Customisasi (sablon/bordir/logo)" class="form-control mb-1">
                </div>
            </div>
            <button type="button" id="add-item" class="btn btn-secondary btn-sm">Tambah Item</button>
        </div>

        <button type="submit" class="btn btn-success">Simpan Order</button>
    </form>
</div>

<script>
let counter = 1;
document.getElementById('add-item').addEventListener('click', function() {
    const container = document.getElementById('items-container');
    const div = document.createElement('div');
    div.classList.add('item-row', 'mb-2');
    div.innerHTML = `
        <input type="text" name="items[${counter}][bahan]" placeholder="Bahan" class="form-control mb-1" required>
        <input type="text" name="items[${counter}][ukuran]" placeholder="Ukuran" class="form-control mb-1" required>
        <input type="number" name="items[${counter}][quantity]" placeholder="Qty" class="form-control mb-1" required>
        <input type="text" name="items[${counter}][customisasi][]" placeholder="Customisasi" class="form-control mb-1">
    `;
    container.appendChild(div);
    counter++;
});
</script>
@endsection
