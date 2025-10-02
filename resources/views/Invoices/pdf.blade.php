<!-- resources/views/invoices/pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; }
        .company-info { margin-bottom: 20px; }
        .invoice-info { margin-bottom: 20px; }
        .customer-info { margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; }
        .text-right { text-align: right; }
        .total-section { margin-top: 20px; }
        .total-row { font-weight: bold; background-color: #f5f5f5; }
        .footer { margin-top: 30px; text-align: center; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>INVOICE</h1>
        <h2>{{ config('app.name') }}</h2>
    </div>

    <div class="company-info">
        <strong>{{ config('app.name') }}</strong><br>
        Jl. Contoh No. 123<br>
        Jakarta 12345<br>
        Telp: (021) 1234-5678<br>
        Email: info@example.com
    </div>

    <div style="display: flex; justify-content: space-between;">
        <div class="invoice-info">
            <strong>Invoice #:</strong> {{ $invoice->invoice_number }}<br>
            <strong>Tanggal:</strong> {{ $invoice->issued_at->format('d/m/Y') }}<br>
            <strong>Jatuh Tempo:</strong> {{ $invoice->due_at->format('d/m/Y') }}<br>
            <strong>Status:</strong> {{ ucfirst($invoice->status) }}
        </div>

        <div class="customer-info">
            <strong>Kepada:</strong><br>
            {{ $invoice->customer_name }}<br>
            {{ $invoice->customer_email }}<br>
            {{ $invoice->customer_address }}<br>
            @if($invoice->customer_phone)
                Telp: {{ $invoice->customer_phone }}
            @endif
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>SKU</th>
                <th>Qty</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td>
                    {{ $item->product_name }}
                    @if($item->description)
                        <br><small>{{ $item->description }}</small>
                    @endif
                </td>
                <td>{{ $item->product_sku ?? '-' }}</td>
                <td>{{ $item->quantity }}</td>
                <td class="text-right">{{ $item->formatted_unit_price }}</td>
                <td class="text-right">{{ $item->formatted_total_price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <table style="width: 300px; margin-left: auto;">
            <tr>
                <td><strong>Subtotal:</strong></td>
                <td class="text-right">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>PPN (11%):</strong></td>
                <td class="text-right">Rp {{ number_format($invoice->tax_amount, 0, ',', '.') }}</td>
            </tr>
            @if($invoice->discount_amount > 0)
            <tr>
                <td><strong>Diskon:</strong></td>
                <td class="text-right">Rp {{ number_format($invoice->discount_amount, 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr class="total-row">
                <td><strong>TOTAL:</strong></td>
                <td class="text-right"><strong>{{ $invoice->formatted_total }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Terima kasih atas kepercayaan Anda!</p>
        <p>{{ config('app.name') }} - {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>