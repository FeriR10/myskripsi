<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    @if (auth()->user()->role_id == 1)
    <h3>Admin</h3>
    @endif
    @if (auth()->user()->role_id == 2)
    <h3>{{ auth()->user()->supplier->nama }}</h3>
    @endif
    @if (auth()->user()->role_id == 3)
    <h3>{{ auth()->user()->dealer->nama }}</h3>
    @endif
    @if (auth()->user()->role_id == 4)
    <h3>{{ auth()->user()->biller->nama }}</h3>
    @endif

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        @if (Auth()->user())

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"> Account</i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Settings</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa- mr-2"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="/logout" class="dropdown-item" onClick="return confirm('Anda Yakin ?')">
                    <i class="fas fa- mr-2"></i> Logout
                </a>
            </div>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="update-profile">
                <div class="modal-body">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Name</label>
                        <input type="name" name="name" class="form-control" value="{{ auth()->user()->name }}">
                        @if($errors->has('name'))
                            <span class="help-block" style="color: red">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}">
                        @if($errors->has('email'))
                            <span class="help-block" style="color: red">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
