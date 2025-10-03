<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Tampilkan semua order
    public function index()
{
    $orders = Order::with('lead', 'items')->latest()->paginate(10);
    return view('admin.orders.index', compact('orders'));
}

 

    // Form order untuk lead follow-up
    public function create(Lead $lead)
    {
        if ($lead->status !== 'follow-up') {
            return redirect()->back()->with('error', 'Lead ini tidak bisa dibuat order.');
        }

        return view('admin.orders.create', compact('lead'));
    }

    // Simpan order
    public function store(Request $request)
{
    $request->validate([
        'lead_id' => 'required|exists:leads,id',
        'items' => 'required|array',
        'items.*.bahan' => 'required|string',
        'items.*.ukuran' => 'required|string',
        'items.*.quantity' => 'required|integer|min:1',
    ]);

    $lead = Lead::findOrFail($request->lead_id);

    // Hitung total harga
    $totalHarga = 0;
    foreach($request->items as $item) {
        $hargaBahan = match($item['bahan']) {
            'cotton' => 50000,
            'combed' => 60000,
            'premium' => 70000,
            default => 0,
        };

        $hargaUkuran = match($item['ukuran']) {
            'S' => 0,
            'M' => 5000,
            'L' => 10000,
            'XL' => 15000,
            'XXL' => 20000,
            default => 0,
        };

        $hargaCustom = 0;
        if(isset($item['customisasi'])) {
            foreach($item['customisasi'] as $val) {
                $hargaCustom += intval($val);
            }
        }

        $totalHarga += ($hargaBahan + $hargaUkuran + $hargaCustom) * $item['quantity'];
    }

    // Simpan order
    $order = \App\Models\Order::create([
        'lead_id' => $lead->id,
        'total_harga' => $totalHarga,
        'status' => 'menunggu pembayaran',
    ]);

    // Simpan order items
    foreach($request->items as $item) {
        \App\Models\OrderItem::create([
            'order_id' => $order->id,
            'bahan' => $item['bahan'],
            'ukuran' => $item['ukuran'],
            'customisasi' => isset($item['customisasi']) ? $item['customisasi'] : null,
            'quantity' => $item['quantity'],
            'harga' => ($item['bahan']=='cotton'?50000:($item['bahan']=='combed'?60000:70000)) + 
                       ($item['ukuran']=='S'?0:($item['ukuran']=='M'?5000:($item['ukuran']=='L'?10000:($item['ukuran']=='XL'?15000:20000)))) +
                       (isset($item['customisasi'])?array_sum($item['customisasi']):0),
        ]);
    }

    // 🚀 Update status lead jadi closing
    $lead->update(['status' => 'closing']);

     return redirect()->route('admin.orders.index')->with('success', 'Order berhasil dibuat!');
}



    //tambahan manual Dzaky untuk update status
    public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:menunggu pembayaran,produksi,selesai',
    ]);

    $order->update(['status' => $request->status]);

    return redirect()->back()->with('success', 'Status order berhasil diubah!');
}

//untuk resources/views/admin/orders/show.blade.php
public function show(Order $order)
{
    $order->load('lead', 'items'); // load relasi
    return view('admin.orders.show', compact('order'));
}

}
