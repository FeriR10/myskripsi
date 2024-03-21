@extends('layouts/main')

@section('title', 'Supplier Pulsa')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Supplier Pulsa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Supplier Pulsa</li>
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
                <h3 class="card-title">Tambah Supplier Pulsa</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="/supplier-pulsa/create">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Supplier</label>
                            <input type="text" class="form-control" value="{{ $data_supplier->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nominal</label>
                            <select name="pulsa_id" id="" class="form-control">
                                {{-- <option value="">Pilih Nominal</option> --}}
                                @foreach ($data_pulsa as $pulsa)
                                    <option value="{{ $pulsa->id }}"> {{ $pulsa->nominal }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kartu</label>
                            <input type="hidden" name="kartu_id" class="form-control" value="{{ $data_kartu->id }}">
                            <input type="text" class="form-control" value="{{ $data_kartu->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Harga Awal</label>
                            <input type="text" name="harga_awal" class="form-control" placeholder="Enter Harga Awal" value="{{ old('harga_awal') }}">
                            @if($errors->has('harga_awal'))
                            <span class="help-block" style="color: red">{{ $errors->first('harga_awal') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Switching</label>
                            <input type="text" name="switching" class="form-control" placeholder="Enter Harga Switching" value="{{ old('switching') }}">
                            @if($errors->has('switching'))
                            <span class="help-block" style="color: red">{{ $errors->first('switching') }}</span>
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
