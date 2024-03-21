@extends('layouts/main')

@section('title', 'User')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
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
                <h3 class="card-title">Edit User</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <h3>Silahkan pilih salah satu dari ke-3 opsi status yang tersedia</h3>
                <form role="form" method="POST" action="/user/{{ $user->id }}/status-update">
                    {{ csrf_field() }}
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Supplier</label>
                            <select name="supplier_id" id="" class="form-control">
                                <option value="">Pilih Supplier</option>
                                @foreach ($data_supplier as $supplier)
                                    <option value="{{ $supplier->id }}"> {{ $supplier->nama }} </option>
                                @endforeach
                            </select>
                            @if($errors->has('supplier_id'))
                            <span class="help-block" style="color: red">{{ $errors->first('supplier_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Dealer</label>
                            <select name="dealer_id" id="" class="form-control">
                                <option value="">Pilih Dealer</option>
                                @foreach ($data_dealer as $dealer)
                                    <option value="{{ $dealer->id }}"> {{ $dealer->nama }} </option>
                                @endforeach
                            </select>
                            @if($errors->has('dealer_id'))
                            <span class="help-block" style="color: red">{{ $errors->first('dealer_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Biller</label>
                            <select name="biller_id" id="" class="form-control">
                                <option value="">Pilih Biller</option>
                                @foreach ($data_biller as $biller)
                                    <option value="{{ $biller->id }}"> {{ $biller->nama }} </option>
                                @endforeach
                            </select>
                            @if($errors->has('biller_id'))
                            <span class="help-block" style="color: red">{{ $errors->first('biller_id') }}</span>
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
