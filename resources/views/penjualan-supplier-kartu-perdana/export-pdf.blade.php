<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="main-content">
        <div class="container">
            <h2 style="text-align: center">Data Penjualan Supplier Kartu Perdana</h2>
            <p style="text-align: center">
                @if (auth()->user()->role_id != 1)
                    {{ $supplier->supplier->nama }}
                @endif
            </p>
            <table border style="text-align: center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Supplier</th>
                        <th>Dealer</th>
                        <th>Kartu</th>
                        <th>Harga Beli</th>
                        <th>Switching</th>
                        <th>Harga Jual</th>
                        <th>Jumlah Transaksi</th>
                        <th>Total Harga Jual</th>
                        <th>Total Harga Beli</th>
                        <th>Keuntungan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penjualan_skp as $penjualan)
                    <tr>
                        <td>{{ $penjualan->id }}</td>
                        <td>{{ $penjualan->supplier->nama }}</td>
                        <td>{{ $penjualan->dealer->nama }}</td>
                        <td>{{ $penjualan->kartu->nama }}</td>
                        <td>Rp. {{ $penjualan->harga_beli }}</td>
                        <td>Rp. {{ $penjualan->switching }}</td>
                        <td>Rp. {{ $penjualan->harga_jual }}</td>
                        <td>{{ $penjualan->jumlah_transaksi }}</td>
                        <td>Rp. {{ $penjualan->total_harga_jual }}</td>
                        <td>Rp. {{ $penjualan->total_harga_beli }}</td>
                        <td>Rp. {{ $penjualan->keuntungan }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Supplier</th>
                        <th>Dealer</th>
                        <th>Kartu</th>
                        <th>Harga Beli</th>
                        <th>Switching</th>
                        <th>Harga Jual</th>
                        <th>Jumlah Transaksi</th>
                        <th>Total Harga Jual</th>
                        <th>Total Harga Beli</th>
                        <th>Keuntungan</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>

</html>
