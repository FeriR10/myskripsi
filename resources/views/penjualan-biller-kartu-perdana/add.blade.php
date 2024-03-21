@extends('layouts/main')

@section('title', 'Penjualan Biller Pulsa')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penjualan Biller Pulsa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Penjualan Biller Pulsa</li>
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
                <h3 class="card-title">Tambah Penjualan Biller Pulsa</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="/penjualan-biller-kartu-perdana/create">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <select name="biller_kartu_perdana_id" id="" class="form-control">
                                {{-- <option value="">Pilih Supplier</option> --}}
                                @foreach ($data_biller_kartu_perdana as $biller_kartu_perdana)
                                    <option value="{{ $biller_kartu_perdana->id }}">Kartu {{ $biller_kartu_perdana->kartu->nama }} Harga jual Rp.{{ $biller_kartu_perdana->harga_jual }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Transaksi</label>
                            <input type="number" min="1" name="jumlah_transaksi" class="form-control" placeholder="Enter Jumlah Transaksi" value="{{ old('switching') }}">
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
