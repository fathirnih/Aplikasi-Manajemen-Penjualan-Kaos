<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Order untuk {{ $lead->nama }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Tombol tambah order --}}
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">List Order</h3>
                    <a href="{{ route('orders.create', $lead->id) }}" 
                       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        + Tambah Order
                    </a>
                </div>

                {{-- Tabel daftar order --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ID Order</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tanggal</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Total Harga</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                                <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($lead->orders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2">#{{ $order->id }}</td>
                                    <td class="px-4 py-2">{{ $order->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-4 py-2">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 rounded text-white 
                                            @if($order->status === 'menunggu pembayaran') bg-yellow-500 
                                            @elseif($order->status === 'diproses produksi') bg-blue-500 
                                            @elseif($order->status === 'produksi selesai') bg-indigo-600 
                                            @elseif($order->status === 'dikirim') bg-purple-500 
                                            @else bg-green-600 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <a href="{{ route('orders.show', $order->id) }}" 
                                           class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 text-sm">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                        Belum ada order untuk lead ini
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Tombol kembali ke lead --}}
                <div class="mt-6">
                    <a href="{{ route('leads.show', $lead->id) }}" 
                       class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        ← Kembali ke Lead
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
