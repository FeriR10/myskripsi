@extends('layouts/main')

@section('title', 'Pembelian Biller Pulsa')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pembelian Biller Pulsa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pembelian Biller Pulsa</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form class="form-inline" action="/pembelian-biller-pulsa/filter-date">
                        @csrf
                        <label for="" class="mr-1">Tanggal :</label>
                        <input type="date" class="form-control mr-1" name="tanggal">
                        <button type="submit" class="btn btn-success ml-1">Cari Data</button>
                        <a href="/pembelian-biller-pulsa" class="btn btn-warning ml-1">Refresh Data</a>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pembelian Biller Pulsa <strong></strong></h3>
                <div class="card-tools">
                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 4)
                    <a href="/pembelian-biller-pulsa/export-pdf" class="btn btn-primary">Export PDF</a>
                    @endif
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('status'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="btn btn-success close" data-dismiss="alert" sty>&times;</button>
                    {{Session::get('message')}}
                </div>
                @endif
                <table id="example1" class="table table-bordered table-striped" style="text-align: center">
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
                            <th>Tanggal</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_pembelian as $pembelian)
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
                            <td>{{ $pembelian->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if (auth()->user()->role_id == 4)
                                {{-- <a class="btn btn-danger btn-sm" href="/pembelian/{{ $pembelian->id }}/delete"
                                onClick="return confirm('Anda Yakin ?')">Delete</a> --}}
                                {{-- @elseif (auth()->user()->role_id == 2)
                                    @if ( $pembelian->status == 'pending' )    
                                        <a class="btn btn-warning btn-sm" href="/pembelian-dealer-kartu-perdana/{{ $pembelian->id }}/approved"
                                        onClick="return confirm('Anda Yakin ?')">Approved</a>
                                    @endif --}}
                                @else
                                -
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
                            <th>Tanggal</th>
                            <th>Option</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
