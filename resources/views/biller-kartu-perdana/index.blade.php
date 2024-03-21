@extends('layouts/main')

@section('title', 'Biller Kartu Perdana')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Biller Kartu Perdana</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Biller Kartu Perdana</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Biller Kartu Perdana</h3>
                <div class="card-tools">
                    @if (auth()->user()->role_id == 4)
                    <a href="/biller-kartu-perdana/add" class="btn btn-primary">Beli Kartu Perdana</a>
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
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Dealer</th>
                            <th>Kartu</th>
                            <th>Harga Beli</th>
                            <th>Switching</th>
                            <th>Harga Jual</th>
                            <th>Jumlah Transaksi</th>
                            <th>Stok</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_biller_kartu_perdana as $biller_kartu_perdana)
                        <tr>
                            <td>{{ $biller_kartu_perdana->id }}</td>
                            <td>{{ $biller_kartu_perdana->dealer->nama }}</td>
                            <td>{{ $biller_kartu_perdana->kartu->nama }}</td>
                            <td>Rp. {{ $biller_kartu_perdana->harga_beli }}</td>
                            <td>Rp. {{ $biller_kartu_perdana->switching }}</td>
                            <td>Rp. {{ $biller_kartu_perdana->harga_jual }}</td>
                            <td>{{ $biller_kartu_perdana->jumlah_transaksi }}</td>
                            <td>{{ $biller_kartu_perdana->stok }}</td>
                            <td>
                                @if (auth()->user()->role_id == 4)
                                <a class="btn btn-info btn-sm" href="/biller-kartu-perdana/{{ $biller_kartu_perdana->id }}/tambah-stok">Tambah Stok</a>
                                <a class="btn btn-warning btn-sm" href="/biller-kartu-perdana/{{ $biller_kartu_perdana->id }}/edit">Edit</a>
                                {{-- <a class="btn btn-danger btn-sm" href="/biller-kartu-perdana/{{ $biller_kartu_perdana->id }}/delete"
                                onClick="return confirm('Anda Yakin ?')">Delete</a> --}}
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
                            <th>Kartu</th>
                            <th>Harga Beli</th>
                            <th>Switching</th>
                            <th>Harga Jual</th>
                            <th>Jumlah Transaksi</th>
                            <th>Stok</th>
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
