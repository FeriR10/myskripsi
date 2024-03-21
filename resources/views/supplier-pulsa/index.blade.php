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
                <h3 class="card-title">Supplier Pulsa Data</h3>
                <div class="card-tools">
                    @if (auth()->user()->role_id == 2)
                    <a href="/supplier-pulsa/add" class="btn btn-primary">Tambah Data</a>
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
                            <th>Nominal</th>
                            <th>Kartu</th>
                            <th>Harga Awal</th>
                            <th>Switching</th>
                            <th>Harga Jual</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_supplier_pulsa as $supplier_pulsa)
                        <tr>
                            <td>{{ $supplier_pulsa->id }}</td>
                            <td>{{ $supplier_pulsa->supplier->nama }}</td>
                            <td>{{ $supplier_pulsa->nominal }}</td>
                            <td>{{ $supplier_pulsa->kartu->nama }}</td>
                            <td>Rp. {{ $supplier_pulsa->harga_awal }}</td>
                            <td>Rp. {{ $supplier_pulsa->switching }}</td>
                            <td>Rp. {{ $supplier_pulsa->harga_jual }}</td>
                            <td>
                                @if (auth()->user()->role_id == 2)
                                <a class="btn btn-warning btn-sm" href="/supplier-pulsa/{{ $supplier_pulsa->id }}/edit">Edit</a>
                                {{-- <a class="btn btn-danger btn-sm" href="/supplier-pulsa/{{ $supplier_pulsa->id }}/delete"
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
                            <th>Nominal</th> 
                            <th>Kartu</th> 
                            <th>Harga Awal</th>
                            <th>Switching</th>
                            <th>Harga Jual</th>
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
