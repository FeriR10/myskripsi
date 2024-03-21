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
            <h2 style="text-align: center">Data Pembelian Biller Pulsa</h2>
            <p style="text-align: center">
                @if (auth()->user()->role_id != 1)
                    {{ $biller->biller->nama }}
                @endif
            </p>
            <table border style="text-align: center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dealer</th>
                        <th>Biller</th>
                        <th>Kartu</th>
                        <th>Nominal</th>
                        <th>Harga Beli</th>
                        <th>Switching</th>
                        <th>Harga Jual</th>
                        <th>Jumlah Transaksi</th>
                        <th>Total Harga Jual</th>
                        <th>Total Harga Beli</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembelian_bp as $pembelian)
                    <tr>
                        <td>{{ $pembelian->id }}</td>
                        <td>{{ $pembelian->dealer->nama }}</td>
                        <td>{{ $pembelian->biller->nama }}</td>
                        <td>{{ $pembelian->kartu->nama }}</td>
                        <td>{{ $pembelian->pulsa->nominal }}</td>
                        <td>Rp. {{ $pembelian->harga_beli }}</td>
                        <td>Rp. {{ $pembelian->switching }}</td>
                        <td>Rp. {{ $pembelian->harga_jual }}</td>
                        <td>{{ $pembelian->jumlah_transaksi }}</td>
                        <td>Rp. {{ $pembelian->total_harga_jual }}</td>
                        <td>Rp. {{ $pembelian->total_harga_beli }}</td>
                        <td>
                            @if ($pembelian->status == 'pending')
                                <button class="btn btn-info btn-sm">{{ $pembelian->status }}</button>
                            @elseif ($pembelian->status == 'sukses')
                                <button class="btn btn-success btn-sm">{{ $pembelian->status }}</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Dealer</th>
                        <th>Biller</th>
                        <th>Kartu</th>
                        <th>Nominal</th>
                        <th>Harga Beli</th>
                        <th>Switching</th>
                        <th>Harga Jual</th>
                        <th>Jumlah Transaksi</th>
                        <th>Total Harga Jual</th>
                        <th>Total Harga Beli</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>

</html>
