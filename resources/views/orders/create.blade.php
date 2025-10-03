<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Buat Order untuk {{ $lead->nama }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Alert Success/Error --}}
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('orders.store', $lead->id) }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- Bahan --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Bahan Kaos</label>
                        <select name="bahan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="katun">Katun (+Rp10.000)</option>
                            <option value="polyester">Polyester (+Rp15.000)</option>
                            <option value="dryfit">Dryfit (+Rp20.000)</option>
                        </select>
                    </div>

                    {{-- Ukuran --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ukuran</label>
                        <select name="ukuran" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="S">S (Rp50.000)</option>
                            <option value="M">M (Rp60.000)</option>
                            <option value="L">L (Rp70.000)</option>
                            <option value="XL">XL (Rp80.000)</option>
                            <option value="XXL">XXL (Rp90.000)</option>
                        </select>
                    </div>

                    {{-- Qty --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah (Qty)</label>
                        <input type="number" name="qty" value="1" min="1" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Custom Tambahan --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tambahan Custom</label>
                        <div class="mt-2 space-y-1">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="sablon" value="1" class="rounded border-gray-300">
                                <span class="ml-2">Sablon (+Rp20.000)</span>
                            </label><br>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="bordir" value="1" class="rounded border-gray-300">
                                <span class="ml-2">Bordir (+Rp30.000)</span>
                            </label><br>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="packaging" value="1" class="rounded border-gray-300">
                                <span class="ml-2">Packaging (+Rp10.000)</span>
                            </label><br>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="logo_tambahan" value="1" class="rounded border-gray-300">
                                <span class="ml-2">Logo Tambahan (+Rp15.000)</span>
                            </label>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end">
                        <a href="{{ route('orders.index', $lead->id) }}" 
                           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">
                            Batal
                        </a>
                        <button type="submit" 
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Simpan Order
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
