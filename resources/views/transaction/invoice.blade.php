<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Pondok Selera</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/images/logo.png">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .invoice-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 50px;
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
            <p class="text-muted">Jl. PB.Sudirman No.81, Umbulsari, Kaliboto Lor, Kec. Jatiroto, Kabupaten Lumajang,
                Jawa Timur</p>
            <p class="text-muted">0823-3114-9622</p>
        </div>

        @foreach ($data as $key)
            @php
                $date = \Carbon\Carbon::parse($key->created_at)->toFormattedDateString();
                $time = \Carbon\Carbon::parse($key->created_at)->format('H:i');
            @endphp

            <div class="mt-3">
                <p><strong>Cashier:</strong> {{ $key->user->name }}</p>
                <p><strong>Date:</strong> {{ $date }} - {{ $time }}</p>
            </div>
            <hr>

            <table class="table table-borderless">
                <thead class="border-bottom">
                    <tr>
                        <th>Item</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-end">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($key->transaction_details as $item)
                        <tr>
                            <td>{{ $item->menu->name }}</td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-end">{{ number_format($item->price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3 border-top pt-2">
                <p class="d-flex justify-content-between fw-bold">Total Pembelian: <span>Rp
                        {{ number_format($key->total_transaction, 0, ',', '.') }}</span></p>
                <p class="d-flex justify-content-between fw-bold">Uang Pembeli: <span>Rp
                        {{ number_format($key->total_payment, 0, ',', '.') }}</span></p>
                <p class="d-flex justify-content-between fw-bold text-success">Kembalian: <span>Rp
                        {{ number_format($key->total_payment - $key->total_transaction, 0, ',', '.') }}</span></p>
            </div>
        @endforeach

        <div class="text-center mt-4">
            <p class="mb-0">Terima kasih telah berbelanja di <span class="text-danger fw-bold">Pondok Selera</span>
            </p>
            <p>Semoga hari Anda menyenangkan!</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>
