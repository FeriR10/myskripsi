@extends('layouts/main')

@section('title', 'Dashboard')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="container">

        @if (Session::has('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="btn btn-success close" data-dismiss="alert" sty>&times;</button>
            {{Session::get('message')}}
        </div>
        @endif
    </div>

    <!-- Main content -->
    <section class="content">
        @if ( auth()->user()->role_id == 1)
        <div class="row">
            <!-- ./col -->
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp. {{ $total_keuntungan_sp }} </h3>

                        <p>Total Keuntungan Penjualan Supplier Pulsa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book-outline"></i>
                    </div>
                    <a href="/penjualan-supplier-pulsa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp. {{ $total_keuntungan_skp }} </h3>

                        <p>Total Keuntungan Penjualan Supplier Kartu Perdana</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book-outline"></i>
                    </div>
                    <a href="/penjualan-supplier-kartu-perdana" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp. {{ $total_keuntungan_dp }} </h3>

                        <p>Total Keuntungan Penjualan Dealer Pulsa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book-outline"></i>
                    </div>
                    <a href="/penjualan-dealer-pulsa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp. {{ $total_keuntungan_dkp }} </h3>

                        <p>Total Keuntungan Penjualan Dealer Kartu Perdana</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book-outline"></i>
                    </div>
                    <a href="/penjualan-dealer-kartu-perdana" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- ./col -->
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp. {{ $total_keuntungan_bp }} </h3>

                        <p>Total Keuntungan Penjualan Biller Pulsa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book-outline"></i>
                    </div>
                    <a href="/penjualan-biller-pulsa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp. {{ $total_keuntungan_bkp }} </h3>

                        <p>Total Keuntungan Penjualan Biller Kartu Perdana</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book-outline"></i>
                    </div>
                    <a href="/penjualan-biller-kartu-perdana" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        @endif
        @if (auth()->user()->role_id == 2)
        <div class="row">
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp. {{ $total_keuntungan_sp }} </h3>

                        <p>Total Keuntungan Penjualan Supplier Pulsa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book-outline"></i>
                    </div>
                    <a href="/penjualan-supplier-pulsa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp. {{ $total_keuntungan_skp }} </h3>

                        <p>Total Keuntungan Penjualan Supplier Kartu Perdana</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book-outline"></i>
                    </div>
                    <a href="/penjualan-supplier-kartu-perdana" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        @endif
        @if (auth()->user()->role_id == 3)
        <div class="row">
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp. {{ $total_keuntungan_dp }} </h3>

                        <p>Total Keuntungan Penjualan Dealer Pulsa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book-outline"></i>
                    </div>
                    <a href="/penjualan-dealer-pulsa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp. {{ $total_keuntungan_dkp }} </h3>

                        <p>Total Keuntungan Penjualan Dealer Kartu Perdana</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book-outline"></i>
                    </div>
                    <a href="/penjualan-dealer-kartu-perdana" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        @endif
        @if (auth()->user()->role_id == 4)
        <div class="row">
            <!-- ./col -->
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp. {{ $total_keuntungan_bp }} </h3>

                        <p>Total Keuntungan Penjualan Biller Pulsa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book-outline"></i>
                    </div>
                    <a href="/penjualan-biller-pulsa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp. {{ $total_keuntungan_bkp }} </h3>

                        <p>Total Keuntungan Penjualan Biller Kartu Perdana</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book-outline"></i>
                    </div>
                    <a href="/penjualan-biller-kartu-perdana" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        @endif
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
