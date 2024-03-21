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
                <form role="form" method="POST" action="/penjualan-biller-pulsa/create">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nominal</label>
                            <select name="biller_pulsa_id" id="" class="form-control">
                                {{-- <option value="">Pilih Supplier</option> --}}
                                @foreach ($data_biller_pulsa as $biller_pulsa)
                                    <option value="{{ $biller_pulsa->id }}">Kartu {{ $biller_pulsa->kartu->nama }} Saldo {{ $biller_pulsa->nominal }} Harga jual Rp.{{ $biller_pulsa->harga_jual }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No Konsumen</label>
                            <input type="text" name="no_konsumen" class="form-control" placeholder="Enter No Konsumen" value="{{ old('switching') }}">
                            @if($errors->has('no_konsumen'))
                            <span class="help-block" style="color: red">{{ $errors->first('no_konsumen') }}</span>
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
