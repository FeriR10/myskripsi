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
                    <h1>User Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Page</li>
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
                <h3 class="card-title">User Data</h3>
                <div class="card-tools">
                    @if (auth()->user()->role_id == 1)
                    <a href="/user/add" class="btn btn-primary">Tambah Data</a>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @if ($user->supplier_id != null && $user->dealer_id == null && $user->biller_id == null )
                                <td>Supplier</td>
                            @endif
                            @if ($user->supplier_id == null && $user->dealer_id != null && $user->biller_id == null)
                                <td>Dealer</td>
                            @endif
                            @if ($user->supplier_id == null && $user->dealer_id == null && $user->biller_id != null)
                                <td>Biller</td>
                            @endif
                            @if ($user->supplier_id == null && $user->dealer_id == null && $user->biller_id == null)
                                <td><a href="/user/{{ $user->id }}/status" class="btn btn-sm btn-info btn-block">Opsi</a></td>
                            @endif
                            <td>
                                @if (auth()->user()->role_id == 1)
                                <a class="btn btn-warning btn-sm" href="/user/{{ $user->id }}/edit">Edit</a>
                                {{-- <a class="btn btn-danger btn-sm" href="/user/{{ $user->id }}/delete"
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
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
