<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">CJK</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    @if (auth()->user())
                    {{ auth()->user()->name }}
                    @endif
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (auth()->user()->role_id == 1)
                <li class="nav-item">
                    <a href="/user" class="nav-link {{ request()->is('user','user/add','user/edit') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>User</p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="/pulsa"
                        class="nav-link {{ request()->is('pulsa','pulsa/add','pulsa/edit') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Pulsa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kartu"
                        class="nav-link {{ request()->is('kartu','kartu/add','kartu/edit') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Kartu</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ request()->is('supplier', 'supplier/add', 'supplier/edit', 'supplier-pulsa', 'supplier-pulsa/add', 'supplier-pulsa/edit', 'supplier-kartu-perdana') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Supplier
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/supplier"
                                class="nav-link {{ request()->is('supplier') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Supplier</p>
                            </a>
                        </li>
                        @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/supplier-pulsa"
                                class="nav-link {{ request()->is('supplier-pulsa') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Supplier Pulsa</p>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/supplier-kartu-perdana"
                                class="nav-link {{ request()->is('supplier-kartu-perdana') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Supplier Kartu Perdana</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ request()->is('dealer', 'dealer/add', 'dealer/edit',
                     'dealer-pulsa', 'dealer-pulsa/add', 'dealer-pulsa/edit',
                     'dealer-kartu-perdana') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Dealer
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dealer"
                                class="nav-link {{ request()->is('dealer') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Dealer</p>
                            </a>
                        </li>
                        @if (auth()->user()->role_id == 3 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/dealer-pulsa"
                                class="nav-link {{ request()->is('dealer-pulsa') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Dealer Pulsa</p>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->role_id == 3 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/dealer-kartu-perdana"
                                class="nav-link {{ request()->is('dealer-kartu-perdana') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Dealer Kartu Perdana</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ request()->is('biller', 'biller/add', 'biller/edit', 'biller-pulsa', 'biller-pulsa/add', 'biller-pulsa/edit',
                     'biller-kartu-perdana', 'biller-kartu-perdana/add', 'biller-kartu-perdana/edit',) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Biller
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/biller"
                                class="nav-link {{ request()->is('biller') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Biller</p>
                            </a>
                        </li>
                        @if (auth()->user()->role_id == 4 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/biller-pulsa"
                                class="nav-link {{ request()->is('biller-pulsa') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Biller Pulsa</p>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->role_id == 4 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/biller-kartu-perdana"
                                class="nav-link {{ request()->is('biller-kartu-perdana') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Biller Kartu Perdana</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-header">Approved Pulsa</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ request()->is('approved-supplier-pulsa', 'approved-dealer-pulsa', 'approved-biller-pulsa/add', 'approved-dealer-pulsa') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Data Approved
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/approved-supplier-pulsa"
                                class="nav-link {{ request()->is('approved-supplier-pulsa') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Approved Supplier</p>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->role_id == 3 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/approved-dealer-pulsa"
                                class="nav-link {{ request()->is('approved-dealer-pulsa') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Approved Dealer</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-header">Approved Kartu Perdana</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ request()->is('approved-supplier-kartu-perdana', 'approved-dealer-kartu-perdana') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Data Approved
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/approved-supplier-kartu-perdana"
                                class="nav-link {{ request()->is('approved-supplier-kartu-perdana') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Approved Supplier</p>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->role_id == 3 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/approved-dealer-kartu-perdana"
                                class="nav-link {{ request()->is('approved-dealer-kartu-perdana') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Approved Dealer</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-header">Transaksi Pulsa</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ request()->is('pembelian-supplier-pulsa', 'pembelian-biller-pulsa', 
                    'pembelian-biller-pulsa/add', 'pembelian-dealer-pulsa') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Data Pembelian
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/pembelian-supplier-pulsa"
                                class="nav-link {{ request()->is('pembelian-supplier-pulsa') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Pembelian Supplier</p>
                            </a>
                        </li>
                        @endif --}}
                        @if (auth()->user()->role_id == 3 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/pembelian-dealer-pulsa"
                                class="nav-link {{ request()->is('pembelian-dealer-pulsa', 'pembelian-dealer-pulsa') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Pembelian Dealer</p>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->role_id == 4 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/pembelian-biller-pulsa"
                                class="nav-link {{ request()->is('pembelian-biller-pulsa') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Pembelian Biller</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ request()->is('penjualan-supplier-pulsa', 'penjualan-biller-pulsa', 'penjualan-biller-pulsa/add', 'penjualan-dealer-pulsa') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Data Penjualan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/penjualan-supplier-pulsa"
                                class="nav-link {{ request()->is('penjualan-supplier-pulsa') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Penjualan Supplier</p>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->role_id == 3 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/penjualan-dealer-pulsa"
                                class="nav-link {{ request()->is('penjualan-dealer-pulsa') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Penjualan Dealer</p>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->role_id == 4 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/penjualan-biller-pulsa"
                                class="nav-link {{ request()->is('penjualan-biller-pulsa') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Penjualan Biller</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-header">Transaksi Kartu Perdana</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ request()->is('pembelian-supplier-kartu-perdana', 'pembelian-biller-kartu-perdana', 'pembelian-biller-kartu-perdana/add', 'pembelian-dealer-kartu-perdana') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Data Pembelian
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->role_id == 3 || auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                        <li class="nav-item">
                            <a href="/pembelian-dealer-kartu-perdana"
                                class="nav-link {{ request()->is('pembelian-dealer-kartu-perdana') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Pembelian Dealer</p>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->role_id == 4 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/pembelian-biller-kartu-perdana"
                                class="nav-link {{ request()->is('pembelian-biller-kartu-perdana') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Pembelian Biller</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ request()->is('penjualan-supplier-kartu-perdana', 'penjualan-biller-kartu-perdana', 'penjualan-biller-kartu-perdana/add', 'penjualan-dealer-kartu-perdana') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Data Penjualan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/penjualan-supplier-kartu-perdana"
                                class="nav-link {{ request()->is('penjualan-supplier-kartu-perdana') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Penjualan Supplier</p>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->role_id == 3 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/penjualan-dealer-kartu-perdana"
                                class="nav-link {{ request()->is('penjualan-dealer-kartu-perdana') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Penjualan Dealer</p>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->role_id == 4 || auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/penjualan-biller-kartu-perdana"
                                class="nav-link {{ request()->is('penjualan-biller-kartu-perdana') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Penjualan Biller</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
