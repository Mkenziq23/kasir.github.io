<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="/images/logo.png">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .invoice-container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 60px;
        }

        .header-text {
            font-size: 1.8rem;
            font-weight: bold;
            color: #dc3545;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="invoice-container mt-5 p-4">
        <div class="text-center">
            <img src="/images/logo.png" alt="Logo" class="logo" style="width: 10rem">
            <p class="header-text">Pondok Selera</p>
            <p class="text-muted">Jl. PB. Sudirman No.81, Umbulsari, Kaliboto Lor, Kec. Jatiroto, Kabupaten Lumajang,
                Jawa Timur</p>
            <p class="text-muted">0823-3114-9622</p>
        </div>
        <hr>
        <h4 class="text-center">Transaction Report</h4>
        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Transaction Date</th>
                    <th>Product</th>
                    <th>Total</th>
                    @can('manager')
                        <th>Payment</th>
                        <th>Profit</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @php
                    $total_profit = 0;
                    $total_transaction = 0;
                @endphp
                @foreach ($data as $item)
                    @php
                        $profit_items = 0;
                        foreach ($item->transaction_details as $detail) {
                            $profit_items += ($detail->menu->price - $detail->menu->modal) * $detail->qty;
                        }
                        $total_profit += $profit_items;
                        $total_transaction += $item->total_transaction;
                    @endphp
                    <tr>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>
                            @foreach ($item->transaction_details as $detail)
                                {{ $detail->menu->name }},
                            @endforeach
                        </td>
                        <td>Rp. {{ number_format($item->total_transaction, 0, ',', '.') }}</td>
                        @can('manager')
                            <td>Rp. {{ number_format($item->total_transaction, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($profit_items, 0, ',', '.') }}</td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    @can('manager')
                        <th colspan="3" class="text-end">Total Revenue</th>
                        <td colspan="2">Rp. {{ number_format($total_transaction, 0, ',', '.') }}</td>
                    @endcan
                    @can('cashier')
                        <th colspan="2" class="text-end">Total Transactions</th>
                        <td>Rp. {{ number_format($total_transaction, 0, ',', '.') }}</td>
                    @endcan
                </tr>
                @can('manager')
                    <tr>
                        <th colspan="3" class="text-end">Total Profit</th>
                        <td colspan="2">Rp. {{ number_format($total_profit, 0, ',', '.') }}</td>
                    </tr>
                @endcan
            </tfoot>
        </table>
    </div>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>
