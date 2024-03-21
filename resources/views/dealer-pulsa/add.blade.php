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
                <h3 class="card-title">Tambah Dealer Pulsa</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="/dealer-pulsa/create">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <select name="supplier_pulsa_id" id="" class="form-control">
                                {{-- <option value="">Pilih Supplier</option> --}}
                                @foreach ($data_supplier_pulsa as $supplier_pulsa)
                                    <option value="{{ $supplier_pulsa->id }}">Kartu {{ $supplier_pulsa->kartu->nama }} Saldo {{ $supplier_pulsa->nominal }} Harga jual supplier Rp.{{ $supplier_pulsa->harga_jual }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Switching</label>
                            <input type="text" name="switching" class="form-control" placeholder="Enter Jumlah Switching" value="{{ old('switching') }}">
                            @if($errors->has('switching'))
                            <span class="help-block" style="color: red">{{ $errors->first('switching') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Jumlah Transaksi</label>
                            <input type="text" name="jumlah_transaksi" class="form-control" placeholder="Enter Jumlah Transaksi" value="{{ old('jumlah_transaksi') }}">
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
