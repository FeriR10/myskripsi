@extends('layouts/main')

@section('title', 'Dealer Kartu Perdana')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dealer Kartu Perdana</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dealer Kartu Perdana</li>
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
                <h3 class="card-title">Tambah Stok Kartu Perdana</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="/dealer-kartu-perdana/{{ $data_dealer_kartu_perdana->id }}/create-tambah-stok">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="jumlah_transaksi" class="form-control" placeholder="Enter Jumlah Transaksi" value="Kartu {{ $data_dealer_kartu_perdana->kartu->nama }} | Sisa Jumlah Transaksi {{ $data_dealer_kartu_perdana->jumlah_transaksi }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Transaksi</label>
                            <input type="number" min="1" max="" name="jumlah_transaksi" class="form-control" placeholder="Enter Jumlah Transaksi" value="{{ old('jumlah_transaksi') }}">
                            @if($errors->has('jumlah_transaksi'))
                            <span class="help-block" style="color: red">{{ $errors->first('jumlah_transaksi') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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
