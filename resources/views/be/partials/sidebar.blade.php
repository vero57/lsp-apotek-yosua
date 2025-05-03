@php
    $user = Auth::guard('web')->user();
@endphp
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                @if($user && $user->jabatan === 'apotekar')
                    <li class="{{ request()->routeIs('be.admin.distributor') ? 'active' : '' }}">
                        <a href="{{ route('be.admin.distributor') }}"><i class="fa fa-ambulance"></i> <span>Distributor</span></a>
                    </li>
                    <li class="{{ request()->routeIs('be.admin.pembelianobat') ? 'active' : '' }}">
                        <a href="{{ route('be.admin.pembelianobat') }}"><i class="fa fa-hospital-o"></i> <span>Pembelian Obat</span></a>
                    </li>
                @else
                    <li class="{{ request()->routeIs('be.admin.index') ? 'active' : '' }}">
                        <a href="{{ route('be.admin.index') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                    </li>
                    <li class="{{ request()->routeIs('be.admin.users') ? 'active' : '' }}">
                        <a href="{{ route('be.admin.users') }}"><i class="fa fa-users"></i> <span>Users</span></a>
                    </li>
                    <li class="{{ request()->routeIs('be.admin.products') ? 'active' : '' }}">
                        <a href="{{ route('be.admin.products') }}"><i class="fa fa-medkit"></i> <span>Obat  </span></a>
                    </li>
                    <li class="{{ request()->routeIs('be.admin.pelanggan') ? 'active' : '' }}">
                        <a href="{{ route('be.admin.pelanggan') }}"><i class="fa fa-user"></i> <span>Pelanggan</span></a>
                    </li>
                    <li class="{{ request()->routeIs('be.admin.distributor') ? 'active' : '' }}">
                        <a href="{{ route('be.admin.distributor') }}"><i class="fa fa-ambulance"></i> <span>Distributor</span></a>
                    </li>
                    <li class="{{ request()->routeIs('be.admin.pembelianobat') ? 'active' : '' }}">
                        <a href="{{ route('be.admin.pembelianobat') }}"><i class="fa fa-hospital-o"></i> <span>Pembelian Obat</span></a>
                    </li>
                    <li>
                        <a href="chat.html"><i class="fa fa-comments"></i> <span>Chat</span> <span class="badge badge-pill bg-primary float-right">5</span></a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>