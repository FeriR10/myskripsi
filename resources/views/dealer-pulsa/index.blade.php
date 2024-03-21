@extends('layouts/main')

@section('title', 'Dealer Pulsa')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dealer Pulsa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dealer Pulsa</li>
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
                <h3 class="card-title">Dealer Pulsa Data</h3>
                <div class="card-tools">
                    @if (auth()->user()->role_id == 3)
                    <a href="/dealer-pulsa/add" class="btn btn-primary">Beli Pulsa</a>
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
                            <th>Supplier</th>
                            <th>Kartu</th>
                            <th>Nominal</th>
                            <th>Harga Beli</th>
                            <th>Switching</th>
                            <th>Harga Jual</th>
                            <th>Jumlah Transaksi</th>
                            <th>Total Saldo</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_dealer_pulsa as $dealer_pulsa)
                        <tr>
                            <td>{{ $dealer_pulsa->id }}</td>
                            <td>{{ $dealer_pulsa->supplier->nama }}</td>
                            <td>{{ $dealer_pulsa->kartu->nama }}</td>
                            <td>{{ $dealer_pulsa->nominal }}</td>
                            <td>Rp. {{ $dealer_pulsa->harga_beli }}</td>
                            <td>Rp. {{ $dealer_pulsa->switching }}</td>
                            <td>Rp. {{ $dealer_pulsa->harga_jual }}</td>
                            <td>{{ $dealer_pulsa->jumlah_transaksi }}</td>
                            <td>{{ $dealer_pulsa->total_saldo }}</td>
                            <td>
                                @if (auth()->user()->role_id == 3)
                                <a class="btn btn-info btn-sm" href="/dealer-pulsa/{{ $dealer_pulsa->id }}/tambah-saldo">Tambah Saldo</a>
                                <a class="btn btn-warning btn-sm" href="/dealer-pulsa/{{ $dealer_pulsa->id }}/edit">Edit</a>
                                {{-- <a class="btn btn-danger btn-sm" href="/dealer-pulsa/{{ $dealer_pulsa->id }}/delete"
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
                            <th>Supplier</th>
                            <th>Kartu</th>
                            <th>Nominal</th>
                            <th>Harga Beli</th>
                            <th>Switching</th>
                            <th>Harga Jual</th>
                            <th>Jumlah Transaksi</th>
                            <th>Total Saldo</th>
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
