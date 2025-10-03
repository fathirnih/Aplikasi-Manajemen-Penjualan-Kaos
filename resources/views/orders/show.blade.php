<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Order #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6 space-y-6">

                {{-- Informasi Lead --}}
                <div>
                    <h3 class="text-lg font-semibold mb-3 border-b pb-2">📌 Data Lead</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <p><strong>Nama:</strong> {{ $order->lead->nama }}</p>
                        <p><strong>Email:</strong> {{ $order->lead->email }}</p>
                        <p><strong>Telepon:</strong> {{ $order->lead->telepon }}</p>
                        <p><strong>Alamat:</strong> {{ $order->lead->alamat }}</p>
                    </div>
                </div>

                {{-- Detail Order --}}
                <div>
                    <h3 class="text-lg font-semibold mb-3 border-b pb-2">🛍️ Detail Pesanan</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <p><strong>Bahan:</strong> {{ ucfirst($order->bahan) }}</p>
                        <p><strong>Ukuran:</strong> {{ $order->ukuran }}</p>
                        <p><strong>Jumlah (Qty):</strong> {{ $order->qty }}</p>
                        <p><strong>Status:</strong> 
                            <span class="px-2 py-1 text-xs rounded 
                                @if($order->status == 'menunggu pembayaran') bg-yellow-200 text-yellow-700 
                                @elseif($order->status == 'diproses') bg-blue-200 text-blue-700
                                @elseif($order->status == 'selesai') bg-green-200 text-green-700
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                    </div>

                    {{-- Tambahan Custom --}}
                    <div class="mt-4">
                        <p class="font-semibold">Tambahan Custom:</p>
                        <ul class="list-disc ml-6 text-sm">
                            @if($order->sablon) <li>Sablon (+Rp20.000)</li> @endif
                            @if($order->bordir) <li>Bordir (+Rp30.000)</li> @endif
                            @if($order->packaging) <li>Packaging (+Rp10.000)</li> @endif
                            @if($order->logo_tambahan) <li>Logo Tambahan (+Rp15.000)</li> @endif
                            @if(!$order->sablon && !$order->bordir && !$order->packaging && !$order->logo_tambahan)
                                <li>Tidak ada tambahan</li>
                            @endif
                        </ul>
                    </div>
                </div>

                {{-- Total Harga --}}
                <div class="border p-4 rounded bg-green-50 text-center">
                    <h3 class="text-lg font-semibold">💰 Total Harga</h3>
                    <p class="text-3xl font-bold text-green-700 mt-2">
                        Rp{{ number_format($order->total_harga, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-between items-center mt-6">
                    <a href="{{ route('orders.index', $order->lead->id) }}" 
                       class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        ⬅️ Kembali
                    </a>

                    {{-- Opsional: Update Status --}}
                    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="flex space-x-2">
                        @csrf
                        @method('PUT')
                        <select name="status" class="border rounded px-2 py-1 text-sm">
                            <option value="menunggu pembayaran" {{ $order->status == 'menunggu pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                            <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">
                            Update Status
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
