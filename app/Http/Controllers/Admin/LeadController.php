<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $leads = Lead::when($status, fn($q) => $q->where('status', $status))->paginate(10);

        return view('admin.leads.index', compact('leads', 'status'));

    }

    public function create()
    {
        return view('admin.leads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kontak' => 'required',
        ]);

        Lead::create($request->all());

        return redirect()->route('leads.index')->with('success', 'Lead berhasil ditambahkan!');
    }

    public function edit(Lead $lead)
    {
        return view('admin.leads.edit', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'nama' => 'required',
            'kontak' => 'required',
        ]);

        $lead->update($request->all());

        return redirect()->route('leads.index')->with('success', 'Lead berhasil diperbarui!');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead berhasil dihapus!');
    }

    public function updateStatus(Request $request, Lead $lead)
{
    $request->validate([
        'status' => 'required|in:baru,follow-up,closing,gagal',
    ]);

    $lead->update(['status' => $request->status]);

    return redirect()->route('leads.index')->with('success', 'Status lead berhasil diubah!');
}

}
