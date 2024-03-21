@extends('layouts/main')

@section('title', 'Biller Pulsa')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Biller Pulsa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Biller Pulsa</li>
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
                <h3 class="card-title">Tambah Biller Pulsa</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="/biller-pulsa/create">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nominal</label>
                            <select name="dealer_pulsa_id" id="" class="form-control">
                                {{-- <option value="">Pilih Supplier</option> --}}
                                @foreach ($data_dealer_pulsa as $dealer_pulsa)
                                    <option value="{{ $dealer_pulsa->id }}">{{ $dealer_pulsa->dealer->nama }} | Kartu {{ $dealer_pulsa->kartu->nama }} | Saldo {{ $dealer_pulsa->nominal }} | Harga jual {{ $dealer_pulsa->dealer->nama }} Rp.{{ $dealer_pulsa->harga_jual }} | Maks Jumlah Transaksi {{ $dealer_pulsa->jumlah_transaksi }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Switching</label>
                            <input type="number" min="1" name="switching" class="form-control" placeholder="Enter Jumlah Switching" value="{{ old('switching') }}">
                            @if($errors->has('switching'))
                            <span class="help-block" style="color: red">{{ $errors->first('switching') }}</span>
                            @endif
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
