<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Products List</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            margin: 15px;
            color: #374151;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            background-color: #ffffff;
            font-size: 9px;
        }
        th, td {
            border: 1px solid #e5e7eb;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f3f4f6;
            font-weight: bold;
            color: #1f2937;
            font-size: 10px;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .header {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e5e7eb;
            position: relative;
            min-height: 100px;
        }
        .logo-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 200px;
        }
        .logo {
            max-width: 200px;
            max-height: 100px;
        }
        .header-content {
            text-align: center;
            margin-left: 160px;
            margin-right: 150px;
            margin-top: 15px;
        }
        .header h1 {
            color: #1f2937;
            margin: 0;
            padding: 0;
            font-size: 18px;
        }
        .header p {
            color: #6b7280;
            margin: 5px 0 0 0;
            font-size: 12px;
        }
        .company-info {
            position: absolute;
            top: 10px;
            right: 0;
            text-align: right;
            font-size: 10px;
            color: #6b7280;
            width: 140px;
        }
        .date {
            text-align: right;
            margin-bottom: 20px;
            font-size: 12px;
            color: #6b7280;
        }
        .quantity-warning {
            color: #dc2626;
            font-weight: bold;
        }
        .quantity-low {
            color: #f59e0b;
            font-weight: bold;
        }
        .quantity-good {
            color: #059669;
            font-weight: bold;
        }
        .summary {
            margin-top: 30px;
            margin-bottom: 10px;
            padding: 20px;
            background-color: #f3f4f6;
            border-radius: 8px;
        }
        .summary h2 {
            color: #1f2937;
            font-size: 16px;
            margin: 0 0 15px 0;
        }
        .summary-grid {
            display: table;
            width: 100%;
            margin-top: 10px;
        }
        .summary-item {
            display: table-cell;
            width: 25%;
            padding: 10px;
            text-align: center;
        }
        .summary-value {
            font-size: 14px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 3px;
        }
        .summary-label {
            font-size: 9px;
            color: #6b7280;
            text-transform: uppercase;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
            color: #9ca3af;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        .page-number {
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <img src="{{ public_path('images/stock-logo.png') }}" alt="OPTISTOCK Logo" class="logo">
        </div>
        <div class="header-content">
            <h1>Inventory Report</h1>
            <p>Complete Product List and Stock Status</p>
        </div>
        <div class="company-info">
            <strong>OPTISTOCK</strong><br>
            123 Business Street<br>
            City, Azrou<br>
            +212 678 420419
        </div>
    </div>
    
    <div class="date">
        Report generated on: {{ date('Y-m-d H:i:s') }}
    </div>

    <div class="summary">
        {{-- <h2>Inventory Summary</h2> --}}
        <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-value">{{ $products->count() }}</div>
                <div class="summary-label">Total Products</div>
            </div>
            <div class="summary-item">
                <div class="summary-value">{{ $products->where('quantity', 0)->count() }}</div>
                <div class="summary-label">Out of Stock</div>
            </div>
            <div class="summary-item">
                <div class="summary-value">{{ $products->where('quantity', '>', 0)->where('quantity', '<=', DB::raw('minimum_quantity'))->count() }}</div>
                <div class="summary-label">Low Stock</div>
            </div>
            <div class="summary-item">
                <div class="summary-value">{{ \App\Helpers\CurrencyHelper::format($products->sum('price')) }}</div>
                <div class="summary-label">Total Value</div>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock Status</th>
                <th>Min. Qty</th>
                <th>Unit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ \App\Helpers\CurrencyHelper::format($product->price) }}</td>
                    <td>
                        @if($product->quantity == 0)
                            <span class="quantity-warning">Out of Stock</span>
                        @elseif($product->quantity <= $product->minimum_quantity)
                            <span class="quantity-low">Low Stock ({{ $product->quantity }})</span>
                        @else
                            <span class="quantity-good">{{ $product->quantity }} {{ $product->unit }}</span>
                        @endif
                    </td>
                    <td>{{ $product->minimum_quantity }}</td>
                    <td>{{ $product->unit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        © {{ date('Y') }} OPTISTOCK - Inventory Management System<br>
        <small>This is a computer-generated document. No signature is required.</small>
    </div>
    
    <div class="page-number">
        Page 1 of 1
    </div>
</body>
</html> 